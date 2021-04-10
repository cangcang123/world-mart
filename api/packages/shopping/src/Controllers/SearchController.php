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

class SearchController extends Controller
{
    protected $profileModel = UserProfile::class;
    protected $bannerModel = Banner::class;
    protected $productModel = Product::class;
    protected $categoryModel = Category::class;

    public function __construct()
    {
        // $this->middleware('APIToken');
    }

    public function search(Request $request) {
        $type = $request->type;
        $text = $request->text;

        switch ($type) {
            case 'product':
                return Product::where('status',1)->where('name', 'like', "%{$text}%")->offset(0)->limit(20)->orderBy('created_at', 'desc')->get()->toArray();
                break;
            case 'category':
                return Category::where('status',1)->where('name', 'like', "%{$text}%")->offset(0)->limit(20)->orderBy('created_at', 'desc')->get()->toArray();
                break;
            case 'brand':
                return Brand::where('status',1)->where('name', 'like', "%{$text}%")->offset(0)->limit(20)->orderBy('created_at', 'desc')->get()->toArray();
                break;
        }
    }

    public function searchPaging(Request $request) {
        $type = $request->type;
        $offset = $request->offset;
        $text = $request->text;
        $limit = 20;

        switch ($type) {
            case 'product':
                return Product::where('status',1)->where('name', 'like', "%{$text}%")->offset($offset)->limit($limit)->orderBy('created_at', 'desc')->get()->toArray();
                break;
            case 'category':
                return Category::where('status',1)->where('name', 'like', "%{$text}%")->offset($offset)->limit($limit)->orderBy('created_at', 'desc')->get()->toArray();
                break;
            case 'brand':
                return Brand::where('status',1)->where('name', 'like', "%{$text}%")->offset($offset)->limit($limit)->orderBy('created_at', 'desc')->get()->toArray();
                break;
        }
    }
}
