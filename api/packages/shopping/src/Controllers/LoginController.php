<?php

namespace SHOP\Shopping\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use SHOP\Admin\Library\PhoneValidator;
use Illuminate\Http\Request;
use SHOP\CRM\Models\UserProfile;
use SHOP\CRM\Models\UserReferral;
use SHOP\Shopping\Jobs\AddUserReferral;
use Str;
use Validator;
use DateTime;
use DB;
use Exception;
use Cache;

class LoginController extends Controller
{
    protected $profileModel = UserProfile::class;
    private $apiToken;

    public function __construct()
    {
        // $this->middleware('jwt.auth', ['except' => ['loginMobile']]);
        $this->apiToken = uniqid(base64_encode(Str::random(60)));
    }

    public function loginMobile(Request $request)
    {

        $arr = Validator::make($request->all(), [
            'phone' => 'required',
            'password' => 'required',
        ]);

        if($arr->fails()) {
            return [
                'success' => false,
                'code' => -1,
                'error' => $arr->errors()
            ];
        }

        $form_login = $request->all();
        if (!Auth::guard('user_profiles')->attempt($form_login)) {
            return response()->json(['error' => 'Sai tài khoản hoặc mật khẩu'], 401);
        }
        $profile = UserProfile::where('phone', $request->phone)->first();
        return $this->respondWithToken($profile, $this->apiToken);
    }

    public function getProfileFromToken(Request $request) {
        $arr = Validator::make($request->all(), [
            'token' => 'required',
        ]);

        if($arr->fails()) {
            return [
                'success' => false,
                'code' => -1,
                'error' => $arr->errors()
            ];
        }

        $token = $request->token;
        $profile = UserProfile::where('token', $token)->first();
        if ($profile) {
            return [
                'success' => true,
                'code' => 1,
                'data' => $profile
            ];
        } else {
            return [
                'success' => false,
                'code' => -2,
                'data' => []
            ];
        }
    }

    public function updatePassword(Request $request) {
        $arr = Validator::make($request->all(), [
            'new_password' => 'required',
            'old_password' => 'required',
            'user_id'  => 'required',
        ]);

        if($arr->fails()) {
            return [
                'success' => false,
                'code' => -1,
                'error' => $arr->errors()
            ];
        }

        $new_password = $request->new_password;
        $old_password = $request->old_password;
        $user_id = $request->user_id;
        $profile = UserProfile::where(['id' => $user_id, 'password' => $old_password])->first();
        if (empty($profile)) {
            $this->error('Không tìm thấy user!');
        } else {
            $profile->password = bcrypt($new_password);
            if ($profile->save()) {
                $this->info("Cập nhật thành công!");
            } else {
                $this->error("Có lỗi xảy ra!");
            }
        }
    }

    protected function respondWithToken($profile, $token)
    {
        return response()->json([
            'user' => $profile,
            'access_token' => $token,
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function registerMobile(Request $request) {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'avatar' => 'nullable',
            'referral_user' => 'required',
            'user_share_code' => 'required',
            'gender' => 'nullable',
            'full_name' => 'required',
            'dob' => 'nullable',
            'email' => 'nullable',
            'password' => 'required',
            'confirm_password' => 'required',
        ]);

        if($validator->fails()) {
            return [
                'success' => false,
                'code' => -1,
                'error' => $validator->errors()
            ];
        }

        $post_data = $request->all();
        $phone = PhoneValidator::convertPhone($post_data['phone']);
        $profile = UserProfile::where('phone', $phone)->first();
        if ($profile) {
            return [
                'success' => false,
                'code' => -3,
                'data' => 'User đã tồn tại'
            ];
        } else {
            if ($post_data['password'] == $post_data['confirm_password']) {
                $user = UserProfile::create([
                    'phone' => $phone,
                    'full_name' => isset($post_data['full_name']) ? $post_data['full_name'] : null,
                    'gender' => isset($post_data['gender']) ? $post_data['gender'] : null,
                    'avatar' => isset($post_data['avatar']) ? $post_data['avatar'] : null,
                    'referral_code' => hash('crc32', $phone . rand(1,9999999)),
                    'referral_user' => $post_data['referral_user'],
                    'total_referral' => 20,
                    'token' => $this->apiToken,
                    'dob' => isset($post_data['dob']) ? $post_data['dob'] : null,
                    'email' => isset($post_data['email']) ? $post_data['email'] : null,
                    'password' => bcrypt($post_data['password']),
                ]);

                if($user) {
                    AddUserReferral::dispatch($post_data, $user);
                    return [
                        'success' => true,
                        'code' => 1,
                        'data' => [
                            'user' => $user,
                            'token' => $this->apiToken
                        ]
                    ];
                } else {
                    return [
                        'success' => false,
                        'code' => -3,
                        'data' => 'Đăng ký thất bại, vui lòng thử lại!'
                    ];
                }

            } else {
                return [
                    'success' => false,
                    'code' => -2,
                    'data' => 'Mật khẩu không khớp'
                ];
            }
        }

    }

    public function logoutMobile(Request $request) {
        $token = $request->header('Authorization');
        $user = UserProfile::where('token',$token)->first();
        if($user) {
            $logout = UserProfile::where('id',$user->id)->update([
                'token' => null
            ]);
            if($logout) {
                return [
                    'success' => true,
                    'code' => 1,
                    'data' => 'User logged out'
                ];
            }
          } else {
            return [
                'success' => false,
                'code' => -5,
                'data' => 'User not found'
            ];
          }
    }

    public function verifyReferral(Request $request) {
        $referral = $request->referral;
        if ($referral) {
            //check exist
            $profile = UserProfile::where('referral_code', $referral)->first();
            if ($profile) {
                $count_referral = UserReferral::where('user_share_code', $referral)->count();
                if ($count_referral < $profile->total_referral) {
                    return [
                        'success' => true,
                        'code' => 1,
                        'data' => [
                            'user_share_id' => $profile->id
                        ]
                    ];
                } else {
                    return [
                        'success' => false,
                        'code' => -2,
                        'data' => 'Mã giới thiệu đã được sử dụng quá số lần cho phép'
                    ];
                }
            } else {
                return [
                    'success' => false,
                    'code' => -1,
                    'data' => 'Mã giới thiệu không hợp lệ'
                ];
            }
        } else {
            return [
                'success' => false,
                'code' => -1,
                'data' => 'Mã giới thiệu không hợp lệ'
            ];
        }
    }

    public function checkPhone(Request $request) {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
        ]);

        if($validator->fails()) {
            return [
                'success' => false,
                'code' => -1,
                'error' => $validator->errors()
            ];
        }

        $phone = $request->phone;
        $profile = UserProfile::where('phone', $phone)->first();
        if ($profile) {
            return [
                'success' => false,
                'code' => -2,
                'msg' => 'Số điện thoại đã đăng kí'
            ];
        } else {
            return [
                'success' => true,
                'code' => 1,
                'msg' => 'Số điện thoại chưa đăng ký'
            ];
        }
    }

    public function verifyEmail(Request $request) {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'email' => 'required',
        ]);

        if($validator->fails()) {
            return [
                'success' => false,
                'code' => -1,
                'error' => $validator->errors()
            ];
        }

        $phone = $request->phone;
        $email = $request->email;
        $profile = UserProfile::where(['phone' => $phone, 'email' => $email])->first();
        if ($profile) {
            return [
                'success' => true,
                'code' => 1,
                'msg' => 'Xác minh thành công!'
            ];
        } else {
            return [
                'success' => false,
                'code' => -2,
                'msg' => 'Email không tồn tại'
            ];
        }
    }

    public function resetPassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'email' => 'required',
            'password' => 'required',
            'confirm_password' => 'required',
        ]);

        if($validator->fails()) {
            return [
                'success' => false,
                'code' => -1,
                'error' => $validator->errors()
            ];
        }

        $form = $request->all();
        $profile = UserProfile::where(['phone' => $form['phone'], 'email' => $form['email']])->first();
        if ($profile) {
            if ($form['password'] == $form['confirm_password']) {
                $profile->password = bcrypt($form['password']);
                if ($profile->save()) {
                    return [
                        'success' => true,
                        'code' => 1,
                        'msg' => 'Đổi mật khẩu thành công'
                    ];
                } else {
                    return [
                        'success' => false,
                        'code' => -4,
                        'msg' => 'Có lỗi xảy ra'
                    ];
                }
            } else {
                return [
                    'success' => false,
                    'code' => -3,
                    'msg' => 'Mật khẩu không khớp'
                ];
            }
        } else {
            return [
                'success' => false,
                'code' => -2,
                'msg' => 'User không tồn tại'
            ];
        }
    }
}
