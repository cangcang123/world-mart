<?php

namespace SHOP\CRM\Models;

use Illuminate\Database\Eloquent\Model;
use App\Database\Eloquent\SoftDeletes;

class Sku extends Model
{
    use SoftDeletes;

    // protected $connection = 'mongodb';
    // protected $collection = 'skus';
    protected $table = 'skus';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';
    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'modified_by';

    protected $fillable = [
        'id',
        'name',
        'description',
        'deleted',
        'status',
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
        'slug',
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
