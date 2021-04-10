<?php

namespace SHOP\Shopping\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SHOP\CRM\Models\UserProfile;
use SHOP\CRM\Models\UserReferral;
use SHOP\CRM\Models\Order;
use Validator;
use Exception;
use Carbon\Carbon;
use Cache;
use DB;

class ProfileController extends Controller {

    public function walletInfo(Request $request) {
        $user_id = $request->user_id;
        $user = UserProfile::where('id', $user_id)->first();
        $data = [];
        if ($user) {
            $orders = Order::where(['user_id' => $user_id, 'status' => 3])->get()->toArray();
            $data['user_total_commission'] = $this->getTotalCommissions($orders , $user_id); 
            $data['total_paid'] = $this->getOrderPurchased($orders , $user_id); 
            return $data;
        } else {
            return [
                'success' => false,
                'code' => -2,
                'error' => 'Không có user'
            ];
        }
    }

    private function getTotalCommissions($orders, $user_id) {
        return [
            'orders' => $orders,
            'count' => count($orders),
            'total_commissions' => $orders = Order::where(['user_id' => $user_id, 'status' => 3])->sum('bonus_fee'),
        ];
    }

    private function getOrderPurchased($orders, $user_id) {
        return [
            'count' => count($orders),
            'total_paid' => $orders = Order::where(['user_id' => $user_id, 'status' => 3])->sum('grand_total'),
        ];
    }

    public function indentifyInfo($user_id) {
        $user = UserProfile::where('id', $user_id)->first();
        if ($user) {
            return [
                'success' => true,
                'code' => 1,
                'data' => $user
            ]; 
        } else {
            return [
                'success' => false,
                'code' => -2,
                'error' => 'Không có user'
            ];
        }
    }

    public function updateBanking(Request $request) {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'banking_info' => 'required'
        ]);

        if($validator->fails()) {
            return [
                'success' => false,
                'code' => -1,
                'error' => $validator->errors()
            ];
        }
        $form = $request->all();
        $user = UserProfile::where('id', $form['user_id'])->first();
        if ($user) {
            $user->banking_info = $form['banking_info'];
            if ($user->save()) {
                return [
                    'success' => true,
                    'code' => 1,
                    'error' => 'Lưu thành công!'
                ];
            } else {
                return [
                    'success' => false,
                    'code' => -3,
                    'error' => 'Lưu không thành công!'
                ];
            }
        } 

        return [
            'success' => false,
            'code' => -2,
            'error' => 'Không có user'
        ];
    }

    public function updateIdentity(Request $request) {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'identification' => 'required'
        ]);

        if($validator->fails()) {
            return [
                'success' => false,
                'code' => -1,
                'error' => $validator->errors()
            ];
        }
        $form = $request->all();
        $user = UserProfile::where('id', $form['user_id'])->first();
        if ($user) {
            $user->identification = $form['identification'];
            if ($user->save()) {
                return [
                    'success' => true,
                    'code' => 1,
                    'error' => 'Lưu thành công!'
                ];
            } else {
                return [
                    'success' => false,
                    'code' => -3,
                    'error' => 'Lưu không thành công!'
                ];
            }
        } 

        return [
            'success' => false,
            'code' => -2,
            'error' => 'Không có user'
        ];
    }

    public function paymentHistory(Request $request) {
        $type = $request->type;
        $user_id = $request->user_id;
        $time = $request->time;
        $user = UserProfile::where('id', $user_id)->first();
        if ($user) {
            switch($type) {
                case 1: // Hoa hồng của tôi
                    $query = Order::where(['user_id' => $user_id, 'status' => 3]);
                    if ($time) {
                        $start = $time[0];
                        $end = $time[1];
                        $query->whereBetween('created_at' , [$start, $end]);
                    }
                    return [
                        'orders' => $query->get()->toArray(),
                    ];
                    break;
                case 2: // Hoa hồng thành viên
                    break;
                case 3: // Thu nhập khác
                    break;
                case 4: // Lịch sử thanh toán
                    $query = Order::where(['user_id' => $user_id, 'status' => 3]);
                    if ($time) {
                        $start = $time[0];
                        $end = $time[1];
                        $query->whereBetween('created_at' , [$start, $end]);
                    }
                    return [
                        'orders' => $query->get()->toArray()
                    ];
                    break;
                default: // Tất cả
                    return [];
            }
        } else {
            return [
                'success' => false,
                'code' => -2,
                'error' => 'Không có user'
            ];
        }
    }
}