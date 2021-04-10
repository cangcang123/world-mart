<?php

namespace SHOP\Shopping\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SHOP\CRM\Models\UserProfile;
use SHOP\CRM\Models\Category;
use SHOP\CRM\Models\Brand;
use SHOP\CRM\Models\UserPromotion;
use Validator;
use DateTime;
use DB;
use Exception;
use Carbon\Carbon;
use Cache;

class PromotionController extends Controller
{
    private $data = [];

    public function list(Request $request) {
        $time = $request->time;
        $user_id = $request->user_id;
        $now = Carbon::today();
        if($time) {
            switch($time) {
                case 'upcoming':
                    return UserPromotion::where(['user_id' => $user_id,'status' => 1])->where('start_date', '>', $now)->get();
                    break;
                case 'ongoing':
                    return UserPromotion::where(['user_id' => $user_id,'status' => 1])->where('start_date', '<=', $now)->where('end_date', '>', $now)->get();
                    break;
                case 'closed':
                    return UserPromotion::where(['user_id' => $user_id,'status' => 1])->where('end_date', '<=', $now)->get();
                    break;
            }
        }

        return [];
    }

    public function detail($id) {
        return UserPromotion::where(['id' => $id, 'status' => 1])->get();
    }

    public function closePromo($id) {
        $now = Carbon::today();
        UserPromotion::where('id', $id)
        ->update(['end_date' => $now]);

        return [
            'status' => true
        ];
    }

    public function deletePromo($id) {
        return UserPromotion::where('id', $id)->delete();
    }

    public function edit(Request $request) {
        $validator = Validator::make($request->all(), [
            'promo_id' => 'required',
            'type' => 'required',
            'is_public' => 'nullable',
            'end_date' => 'required',
            'product_id' => 'nullable',
        ]);

        if($validator->fails()) {
            return [
                'success' => false,
                'code' => -1,
                'error' => $validator->errors()
            ];
        }

        $post_data = $request->all();
        $type = $request->type;
        $data = UserPromotion::where(['id' => $post_data['promo_id']])->first();
        if ($data) {
            if ($type == 1) { // order
                $data->type = $type;
                $data->end_date = $post_data['end_date'];
            } elseif ($type == 2) { // product
                $data->type = $type;
                $data->product_id = $post_data['product_id'];
                $data->end_date = $post_data['end_date'];
            }
            $data->save();
            return [
                'success' => true,
                'code' => 1,
                'data' => 'Lưu thành công'
            ];
        }

        return [
            'success' => false,
            'code' => -1,
            'data' => 'Lưu thất bại'
        ];
    }

    public function add(Request $request) {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'type' => 'required',
            'code' => 'required',
            'is_public' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'discount_value' => 'nullable',
            'min_commission_fee' => 'nullable',
            'product_id' => 'nullable',
            'max_use_time' => 'nullable',
        ]);

        if($validator->fails()) {
            return [
                'success' => false,
                'code' => -1,
                'error' => $validator->errors()
            ];
        }

        $post_data = $request->all();
        $code = $post_data['code'];
        $user_id = $post_data['user_id'];
        $profile = UserProfile::where('id', $user_id)->first();
        if ($profile) {
            if ($this->isValidCode($code)) {
                $form_add = $this->createFormData($post_data);
                $promo = UserPromotion::create($form_add);
                if ($promo) {
                    return [
                        'success' => true,
                        'code' => 1,
                        'data' => 'Tạo mã thành công'
                    ];
                } else {
                    return [
                        'success' => false,
                        'code' => -3,
                        'data' => 'Tạo mã thất bại, vui lòng thử lại!'
                    ];
                }
            } else {
                return [
                    'success' => false,
                    'code' => -2,
                    'error' => 'Mã giảm giá đã tồn tại'
                ];
            }
        } else {
            return [
                'success' => false,
                'code' => -4,
                'error' => 'User không tồn tại'
            ];
        }
    }

    private function isValidCode($code) {
        $promo = UserPromotion::where(['code' => $code])->first();
        return $promo ? false : true;
    }

    private function createFormData($post_data) {
        $type = $post_data['type'];
        if ($type == 1) { // order
            $form_add = [
                'user_id' => $post_data['user_id'],
                'type' => $post_data['type'],
                'code' => $post_data['code'],
                'is_public' => $post_data['is_public'],
                'max_use_time' => isset($post_data['max_use_time']) ? $post_data['max_use_time'] : null,
                'start_date' => $post_data['start_date'],
                'end_date' => $post_data['end_date'],
                'discount_value' => isset($post_data['discount_value']) ? $post_data['discount_value'] : 0,
                'min_commission_fee' => isset($post_data['min_commission_fee']) ? $post_data['min_commission_fee'] : 0,
                'status' => 1
            ];
        } else if ($type == 2) { // product
            $form_add = [
                'user_id' => $post_data['user_id'],
                'type' => $post_data['type'],
                'code' => $post_data['code'],
                'is_public' => $post_data['is_public'],
                'product_id' => isset($post_data['product_id']) ? isset($post_data['product_id']): null,
                'max_use_time' => isset($post_data['max_use_time']) ? $post_data['max_use_time'] : null,
                'start_date' => $post_data['start_date'],
                'end_date' => $post_data['end_date'],
                'discount_value' => isset($post_data['discount_value']) ? $post_data['discount_value'] : 0,
                'status' => 1
            ];
        }

        return $form_add;
    }
}
