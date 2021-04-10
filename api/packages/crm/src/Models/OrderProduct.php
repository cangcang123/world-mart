<?php

namespace SHOP\CRM\Models;

use Illuminate\Database\Eloquent\Model;
use App\Database\Eloquent\SoftDeletes;

class OrderProduct extends Model
{
    use SoftDeletes;
    protected $table = 'order_product';

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
        'order_id',
        'product_id',
        'product_name',
        'commission',
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
