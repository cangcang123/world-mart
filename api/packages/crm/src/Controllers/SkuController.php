<?php

namespace SHOP\CRM\Controllers;

use App\Http\Controllers\ApiController;
use App\QueryBuilder\Filters\LikeMongoFilter;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use SHOP\CRM\Models\Sku;
use Illuminate\Support\Str;

class SkuController extends ApiController
{
    protected $model = Sku::class;

    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['checkSku']]);

        $this->filter = [
            'name',
            'status',
            'description',
            'deleted',
            'created_by',
            'modified_by',
            'created_at',
            'updated_at',
            'product_id',
            'thumbnail',
            'color',
            'size',
            'weight',
            'memory',
            'price',
            'promotion_price',
            'location',
            'quality',
            'quantity',
            'sku',
            'bonus_rating',
            'bonus_referral',
            'total_sold',
        ];

        $this->allowedSorts = [
            'id',
            'description',
            'deleted',
            'created_by',
            'modified_by',
            'created_at',
            'updated_at',
            'product_id',
            'thumbnail',
            'color',
            'size',
            'weight',
            'memory',
            'price',
            'promotion_price',
            'location',
            'quality',
            'quantity',
            'sku',
            'bonus_rating',
            'bonus_referral',
            'total_sold',
        ];
    }

    public function count(Request $request)
    {
        $this->authorize('count', [$this->model, $request]);
        return QueryBuilder::for($this->model)
            ->allowedFilters([
            ])
            ->count();
    }

    public function getSkuByProduct(Request $request,$id){
        $this->authorize('list',[$this->model, $request]);
        $skus = Sku::where('product_id',$id)->get();
        return $skus;
    }

    public function checkSku($sku) {
        $sku = $this->model::where('sku', $sku)->first();
        if (!$sku) {
            return [
                'code' => 200,
                'message' => 'Success'
            ];
        }
        return [
            'code' => 400,
            'message' => 'Tên SKU đã tồn tại'
        ];
    }

    public function create(Request $request) {
        $this->authorize('create', [$this->model, $request]);
        $params = $request->all();
        if(empty($params['slug'])) {
            $params['slug'] = Str::slug($params['name']);
        }
        $created = $this->model::create($params);
        if ($created) return response($created, 200);
        return response([], 400);
    }

}
