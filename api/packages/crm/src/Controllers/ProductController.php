<?php
namespace SHOP\CRM\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use SHOP\CRM\Models\Product;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Str;

class ProductController extends ApiController
{
    protected $model = Product::class;

    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['checkProduct']]);

        $this->filter = [
            AllowedFilter::exact('id'),
            'name',
            'title',
            'meta_title',
            'meta_content',
            'description',
            'sub_description',
            'usage',
            'cover_photo',
            'image_url',
            'price',
            // 'size',
            'currency',
            'category',
            'brand',
            'slug',
            // 'color',
            'quota',
            // 'sku',
            // 'memory',
            // 'weight',
            'promotion',
            'discount',
            'rating',
            'origin',
            'bonus_rating',
            'bonus_referral',
            'total_like',
            'tags',
            'is_hot',
            'is_new',
            'question_answer',
            'is_profit',
            'best_seller',
            'relate_product',
            'status',
            'deleted',
            'status_log',
        ];

        $this->allowedSorts = [
            'name',
            'title',
            'meta_title',
            'meta_content',
            'description',
            'sub_description',
            'usage',
            'cover_photo',
            'image_url',
            'price',
            // 'size',
            'currency',
            'category',
            'brand',
            'slug',
            // 'color',
            'quota',
            'rating',
            // 'sku',
            // 'memory',
            // 'weight',
            'promotion',
            'discount',
            'origin',
            'question_answer',
            'bonus_rating',
            'bonus_referral',
            'total_like',
            'tags',
            'is_hot',
            'is_new',
            'is_profit',
            'best_seller',
            'relate_product',
            'status',
            'deleted',
            'status_log',
            'created_at',
        ];
    }

    public function count(Request $request)
    {
        $this->authorize('count', [$this->model, $request]);
        return QueryBuilder::for($this->model)
            ->allowedFilters([
                'name',
            ])
            ->count();
    }

    public function create(Request $request) {
        $this->authorize('create', [$this->model, $request]);
        $params = $request->all();
        if(empty($params['slug'])) {
            $params['slug'] = Str::slug($params['name']);
        }
        $product = $this->model::where('name', $params['name'])->first();
        if (!$product) {
            $created = $this->model::create($params);
            if ($created) return response($created, 200);
            return response([], 400);
        }
        return response([
            'message' => 'Tên sản phẩm đã tồn tại'
        ], 400);
    }

    public function list(Request $request)
    {
        $this->authorize('list', [$this->model, $request]);
        $items = QueryBuilder::for($this->model)
            ->allowedFilters($this->filter)
            ->allowedSorts($this->allowedSorts)
            ->apiPaginate();

        if (is_object($items['entries']) && count($items['entries']) > 0) {
            foreach ($items['entries'] as $i => $entry) {
                $items['entries'][$i]->product_category = $items['entries'][$i]->product_category;
                // $items['entries'][$i]->product_size = $items['entries'][$i]->product_size;
                // $items['entries'][$i]->product_color = $items['entries'][$i]->product_color;
                $items['entries'][$i]->product_origin = $items['entries'][$i]->product_origin;
                $items['entries'][$i]->product_brand = $items['entries'][$i]->product_brand;
            }
        }
        return $items;
    }

    public function checkProduct(Request $request) {
        $name = $request->name;
        $product = $this->model::where('name', $name)->first();
        if (!$product) {
            return [
                'code' => 200,
                'message' => 'Success'
            ];
        }
        return [
            'code' => 400,
            'message' => 'Tên sản phẩm đã tồn tại'
        ];
    }
}
