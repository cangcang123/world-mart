<?php

namespace SHOP\Shopping\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Helpers\NexmoService;
use SHOP\Admin\Library\PhoneValidator;
use Illuminate\Http\Request;
use SHOP\CRM\Models\UserProfile;
use Validator;
use DateTime;
use DB;
use Exception;
use Cache;

class RegisterController extends Controller
{
    protected $profileModel = UserProfile::class;


    public function __construct()
    {
        // $this->middleware('web');
    }

    public function minh(Request $request) {
        dd(1);
    }

    public function createByPhone(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
        ]);

        if($validator->fails()) {
            return [
                'success' => false,
                'error' => $validator->errors()
            ];
        }
        $phone = $request->phone;
        // $phone = PhoneValidator::convertPhone($phone);
        $activeCode = NexmoService::generateRandomString();
        $content = "Your activate code is: $activeCode";
        NexmoService::send($phone, $content);
    
        $result = UserProfile::create([
            'phone' => $phone,
            'referral_code' => hash('crc32', $phone),
            'phone_code' => $activeCode,
        ]);

        return [
            'success' => $result,
            'data' => $phone
        ];
    }    

    public function checkOTP(Request $request) {
        $validator = Validator::make($request->all(), [
            'otp_code' => 'required',
            'phone' => 'required',
        ]);

        if($validator->fails()) {
            return [
                'success' => false,
                'code' => -1,
                'error' => $validator->errors()
            ];
        }

        $otp_code = $request->otp_code;
        $phone = $request->phone;

        $profile = UserProfile::where('phone', $phone)->first();
        if ($profile) {
            if ($otp_code == $profile->phone_code) {
                return [
                    'success' => true,
                    'code' => 200
                ];
            } else {
                return [
                    'success' => true,
                    'code' => -1,
                    'message' => 'OTP không hợp lệ',
                ];
            }
        } else {
            return [
                'success' => false,
                'code' => -2,
                'message' => 'Có lỗi xảy ra vui lòng thử lại!'
            ];
        }
    }

    protected function updateProfile(array $data)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'gender' => 'required',
            'full_name' => 'required',
            'dob' => 'required',
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
        if ($request->password !== $request->confirm_password) {
            return [
                'success' => false,
                'code' => -2,
                'message' => 'Vui lòng kiểm tra lại mật khẩu'
            ];
        }

        return UserProfile::where('phone', $request->phone)->update([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'password' => Hash::make($request->password),
            'status' => 1,
        ]);
    }

    public function me(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'oa_id' => 'required',
                'zalo_id' => 'required',
            ]);

            if($validator->fails()) {
                return [
                    'success' => false,
                    'error' => $validator->errors()
                ];
            }
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => 'Oops! Something wrong.'
            ];
        }
    }
}
