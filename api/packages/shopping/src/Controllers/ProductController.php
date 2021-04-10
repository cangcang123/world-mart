<?php

namespace SHOP\Shopping\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Helpers\NexmoService;
use SHOP\Admin\Library\PhoneValidator;
use Illuminate\Http\Request;
use SHOP\CRM\Models\Product;
use SHOP\CRM\Models\Category;
use SHOP\CRM\Models\Brand;
use Validator;
use DateTime;
use DB;
use Exception;
use Cache;

class ProductController extends Controller
{
    private $data = [];

    public function __construct()
    {
        // $this->middleware('APIToken');
        $this->data['categories'] = Category::where('status', 1)->get()->toArray();
    }

    public function list(Request $request) {
        $product_by_category = [];
        foreach ($this->data['categories'] as $ac) {
            $products = Product::where(['status' => 1, 'category' => $ac['id']])->orderBy('created_at', 'desc')->get();
            $product_by_category[$ac['slug']] = $products;
        }
        $this->data['product_by_category'] = $product_by_category;
        return $this->data;
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

    public function productDetail($id) {
        $this->data['product_detail'] = Product::where('id', $id)->first();
        return $this->data;
    }

    public function categoryDetail($id) {
        $this->data['category_detail'] = Category::where('id', $id)->first();
        return $this->data;
    }

    public function brandDetail($id) {
        $this->data['brand_detail'] = Brand::where('id', $id)->first();
        return $this->data;
    }
}
