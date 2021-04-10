<?php

namespace SHOP\Shopping\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use SHOP\Admin\Library\PhoneValidator;
use Illuminate\Http\Request;
use SHOP\CRM\Models\UserProfile;
use SHOP\CRM\Models\Banner;
use SHOP\CRM\Models\Product;
use SHOP\CRM\Models\Brand;
use SHOP\CRM\Models\Category;
use Str;
use Validator;
use DateTime;
use DB;
use Exception;
use Cache;

class BrandController extends Controller
{
    protected $profileModel = UserProfile::class;
    protected $bannerModel = Banner::class;
    protected $productModel = Product::class;
    protected $categoryModel = Category::class;

    public function __construct()
    {
        // $this->middleware('APIToken');
    }

    public function detail($id) {
        $this->data['total_products'] = Product::where(['brand' => $id, 'status' => 1])->count();
        $this->data['brand_detail'] = Brand::where(['id' => $id, 'status' => 1])->first();
        $this->data['brand_detail']['list_products'] = Product::where(['brand' => $id, 'status' => 1])->offset(0)->limit(20)->orderBy('created_at', 'desc')->get()->toArray();
        return $this->data;
    }

    public function productPaging(Request $request) {
        // $data = $request->all();
        // $data = json_decode($data, true);
        $id = $request->id;
        $offset = $request->offset;
        $limit = 20;

        $products = Product::where(['brand' => $id, 'status' => 1])->offset($offset)->limit($limit)->orderBy('created_at', 'desc')->get()->toArray();
        return $products;
    }

    public function list(Request $request) {
        return Brand::where('status', 1)->get()->toArray();
    }
}
