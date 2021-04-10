<?php

namespace SHOP\CRM\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use SHOP\CRM\Models\OrderProduct;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Str;

class OrderProductController extends ApiController
{
    protected $model = OrderProduct::class;

    public function __construct()
    {
        $this->middleware('jwt.auth');

        $this->filter = [
            AllowedFilter::exact('id'),
            'name',
            'order_code',
            'description',
            'status',
            'created_at',
            'modified_at',
            'created_by',
            'modified_by',
            'deleted',
            'user_id',
            'product_id',
            'commission',
            'product_name',
            'category',
            'brand',
            'origin',
            'order_id',
            'quantity',
            'price',
            'cover_photo',
            'sku'
        ];

        $this->allowedSorts = [
            'id',
            'name',
            'order_code',
            'description',
            'status',
            'created_at',
            'modified_at',
            'created_by',
            'modified_by',
            'deleted',
            'user_id',
            'commission',
            'product_id',
            'product_name',
            'category',
            'brand',
            'origin',
            'order_id',
            'quantity',
            'price',
            'cover_photo',
            'sku'
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
}
