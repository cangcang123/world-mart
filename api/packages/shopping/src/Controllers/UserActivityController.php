<?php

namespace SHOP\Shopping\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SHOP\CRM\Models\Product;
use SHOP\CRM\Models\UserLikeProduct;
use SHOP\CRM\Models\UserProfile;
use Validator;
use DateTime;
use DB;
use Exception;
use Cache;

class UserActivityController extends Controller
{
    private $data = [];

    public function __construct()
    {
        // $this->middleware('APIToken');
    }

    public function userAction(Request $request) {
        $user_id = $request->user_id;
        $user_name = $request->user_name;
        $product_id = $request->product_id;
        $user = UserProfile::where('id', $user_id)->first();
        $product = Product::where('id', $product_id)->first();

        if ($user && $product) {
            $user_like = UserLikeProduct::where(['user_id' => $user_id, 'product_id' => $product_id])->first();
            if ($user_like) {
                $user_like->delete();
            } else {
                $form_add = [
                    'user_id' => $user_id,
                    'product_id' => $product_id,
                    'user_name' => $user_name,
                    'status' => 1,
                    'published_at' => date("Y-m-d H:i:s"),
                ];
                UserLikeProduct::create($form_add);
            }
            return [
                'success' => true,
                'code' => 1,
                'data' => 'Thành công'
            ];
        } else {
            return [
                'success' => false,
                'code' => -1,
                'data' => 'Thông tin không hợp lệ'
            ];
        }
    }
}
