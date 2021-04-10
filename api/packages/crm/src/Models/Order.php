<?php

namespace SHOP\CRM\Models;

use Illuminate\Database\Eloquent\Model;
use App\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    // use SoftDeletes;
    protected $table = 'order';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';

    protected $fillable = [
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
