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

class HomeController extends Controller
{
    protected $profileModel = UserProfile::class;
    protected $bannerModel = Banner::class;
    protected $productModel = Product::class;
    protected $categoryModel = Category::class;

    public function __construct()
    {
        $this->middleware('APIToken');
        $this->data['categories'] = Category::where('status', 1)->get()->toArray();
        $this->data['banners'] = Banner::where('status', 1)->get()->toArray();
        $this->data['brands'] = Brand::where('status', 1)->limit(20)->get()->toArray();
    }

    public function home(Request $request) {
        $this->data['new_product'] = Product::where(['status' => 1, 'is_new' => 1])->orderBy('created_at', 'desc')->get();
        $this->data['best_selling'] = Product::where(['status' => 1, 'best_seller' => 1])->orderBy('created_at', 'desc')->get();
        $this->data['all_products'] = Product::where(['status' => 1])->orderBy('created_at', 'desc')->get();
        // $this->data['high_profit'] = Product::where(['status' => 1, 'is_profit' => 1])->orderBy('created_at', 'desc')->get();
        $this->data['high_profit'] = Product::select(DB::raw('*'),DB::raw('(price*bonus_rating)/100 AS profit'))->where(['status' => 1])->orderBy('profit', 'desc')->get();

        return $this->data;
    }
}
