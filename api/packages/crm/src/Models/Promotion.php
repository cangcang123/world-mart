<?php

namespace SHOP\CRM\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{

    protected $table = 'promotion';
    protected $connection = 'mysql';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';
    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'modified_by';

    protected $fillable = [
        'id',
        'created_at',
        'modified_at',
        'name',
        'description',
        'start_date',
        'end_date',
        'value',
        'code',
        'max_discount_price',
        'min_order_price',
        'note',
        'status',
        'deleted',
        'status_log',
        'created_by',
        'modified_by'
    ];
}
