<?php

namespace SHOP\Shopping\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SHOP\CRM\Models\Product;
use SHOP\CRM\Models\Order;
use SHOP\CRM\Models\OrderProduct;
use SHOP\CRM\Models\UserPromotion;
use SHOP\Shopping\Jobs\AddOrderProduct;
use Validator;
use DateTime;
use DB;
use Exception;
use Carbon\Carbon;
use Cache;

class OrderController extends Controller
{
    public function makeOrder(Request $request) {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'delivery_method' => 'required',
            'order_content' => 'required',
            'delivery_info' => 'required',
            'promo_code' => 'nullable',
            'total_price_by_item' => 'required',
            'shipping_fee' => 'nullable',
            'bonus_fee' => 'nullable',
            'discount' => 'nullable',
            'grand_total' => 'nullable'
        ]);

        if($validator->fails()) {
            return [
                'success' => false,
                'code' => -1,
                'error' => $validator->errors()
            ];
        }

        $post_data = $request->all();
        $form_add = $this->createOrderForm($post_data);
        $result = Order::create($form_add);

        if ($result['id']) {
            AddOrderProduct::dispatch($result, $form_add);
            // AddCustomerActivitiesLog::dispatch($result['id'], $form_add);
            return [
                'success' => true,
                'code' => 1,
                'data' => [
                    'id' => $result['id'],
                    'code' => $result['order_code']
                ],
                'error' => 'Tạo đơn hàng thành công!'
            ];
        } else {
            return [
                'success' => false,
                'code' => -2,
                'error' => 'Có lỗi xảy ra vui lòng thử lại!'
            ];
        }
    }

    private function createOrderForm($form) {
        return [
            'name' => 'Đơn đặt hàng ngày ' . date("Y-m-d H:i:s"),
            'delivery_info' => $form['delivery_info'],
            'user_id' => $form['user_id'],
            'delivery_method' => $form['delivery_method'],
            'promo_code' => isset($form['promo_code']) ? $form['promo_code'] : null,
            'total_price_by_item' => $form['total_price_by_item'],
            'shipping_fee' => isset($form['shipping_fee']) ? $form['shipping_fee'] : 0,
            'bonus_fee' => isset($form['bonus_fee']) ? $form['bonus_fee'] : 0,
            'discount' => isset($form['discount']) ? $form['discount'] : 0,
            'grand_total' => isset($form['grand_total']) ? $form['grand_total'] : 0,
            'status' => 1,
            'payment_method' => 1,
            'order_code' => $this->getOrderCode(),
            'order_content' => $form['order_content'],
        ];
    }

    private function getOrderCode() {
        $time = strtotime('today');
        $my = str_shuffle($time);
        $rand_str = chr(rand(65,90)) . chr(rand(65,90));
        return $rand_str.$my;
    }

    public function detail(Request $request) {
        $id = $request->id;
        $user_id = $request->user_id;
        $order = Order::where(['id' => $id, 'user_id' => $user_id])->first();
        if ($order) {
            return [
                'success' => true,
                'code' => 1,
                'data' => $order
            ];
        } else {
            return [
                'success' => false,
                'code' => -1,
                'error' => 'Không có order'
            ];
        }
    }

    public function getOrderByUser($user_id) {
        if ($user_id) {
            $orders = Order::where('user_id', $user_id)->get()->toArray();
            if (!empty($orders)) {
                return [
                    'success' => true,
                    'code' => 1,
                    'data' => $orders
                ];
            } else {
                return [
                    'success' => false,
                    'code' => -1,
                    'data' => []
                ];
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
