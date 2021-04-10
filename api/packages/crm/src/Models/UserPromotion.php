<?php

namespace SHOP\CRM\Models;

use Illuminate\Database\Eloquent\Model;

class UserPromotion extends Model
{

    protected $table = 'user_promotion';
    protected $connection = 'mysql';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';
    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'modified_by';

    protected $fillable = [
        'id',
        'created_at',
        'modified_at',
        'user_id',
        'type', // 1 => order , 2 => product
        'code',
        'is_public', // 1 => public, 2 => private
        'start_date',
        'end_date',
        'discount_value', // VND
        'min_commission_fee', // VND
        'product_id',
        'max_use_time',
        'used_time',
        'status',
        'deleted',
        'status_log',
        'created_by',
        'modified_by'
    ];
}
