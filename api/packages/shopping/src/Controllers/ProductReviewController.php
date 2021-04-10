<?php

namespace SHOP\Shopping\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SHOP\CRM\Models\ProductReview;
use SHOP\CRM\Models\Product;
use SHOP\CRM\Models\Category;
use SHOP\CRM\Models\Brand;
use Validator;
use DateTime;
use DB;
use Exception;
use Cache;

class ProductReviewController extends Controller
{
    private $data = [];

    public function __construct()
    {
        // $this->middleware('APIToken');
    }

    public function listByProduct($product_id) {
        $list_reviews = ProductReview::where(['product_id' => $product_id, 'status' => 1])->get()->toArray();
        $list_parent = array();
        if (!empty($list_reviews)) {
            // foreach ($list_reviews as $a){
            //     $list_parent[$a['parent_id']][] = $a;
            // }
            // $tree = $this->createTree($list_parent, $list_parent[0]);
            return $list_reviews;
        } else {
            return [];
        }
    }

    private function createTree(&$list, $parent){
        $tree = array();
        foreach ($parent as $k=>$l){
            if(isset($list[$l['id']])){
                $l['children'] = $this->createTree($list, $list[$l['id']]);
            }
            $tree[] = $l;
        }
        return $tree;
    }

    public function submitReview(Request $request) {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'user_name' => 'required',
            'rating' => 'required',
            'product_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'parent_id' => 'nullable',
            'images' => 'nullable',
        ]);

        if($validator->fails()) {
            return [
                'success' => false,
                'code' => -1,
                'error' => $validator->errors()
            ];
        }

        $post_data = $request->all();
        $product = Product::where(['id' => $post_data['product_id'], 'status' => 1])->first();
        if ($product) {
            $form_data = $this->createReviewForm($post_data);
            $result = ProductReview::create($form_data);
            if ($result['id']) {
                return [
                    'success' => true,
                    'code' => 1,
                    'error' => 'Submit thành công'
                ];
            } else {
                return [
                    'success' => false,
                    'code' => -2,
                    'error' => 'Submit thất bại'
                ];
            }
        } else {
            return [
                'success' => false,
                'code' => -1,
                'error' => 'Sản phẩm không tồn tại'
            ];
        }
    }

    private function createReviewForm($post_data) {
        return [
            'user_id' => $post_data['user_id'],
            'user_name' => $post_data['user_name'],
            'rating' => $post_data['rating'],
            'product_id' => $post_data['product_id'],
            'title' => $post_data['title'],
            'description' => $post_data['description'],
            'parent_id' => isset($post_data['parent_id']) ? $post_data['parent_id'] : null,
            'images' => isset($post_data['images']) ? $post_data['images'] : null,
            'publish_time' => date('Y/m/d H:i:s')
        ];
    }
}
