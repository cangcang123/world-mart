<?php

namespace SHOP\CRM\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use SHOP\CRM\Models\Order;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Str;

class OrderController extends ApiController
{
    protected $model = Order::class;

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
            'tax',
            'discount',
            'promo_code',
            'total_price_by_item', // giá theo từng sản phẩm
            'total_price',
            'grand_total',
            'shipping_fee',
            'bonus_fee',
            'delivery_method',
            'delivery_info',
            'order_content',
            'payment_method',
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
            'tax',
            'discount',
            'promo_code',
            'total_price_by_item', // giá theo từng sản phẩm
            'total_price',
            'grand_total',
            'shipping_fee',
            'bonus_fee',
            'delivery_method',
            'delivery_info',
            'order_content',
            'payment_method',
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
