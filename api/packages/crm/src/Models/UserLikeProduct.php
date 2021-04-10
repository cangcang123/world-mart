<?php

namespace SHOP\CRM\Models;

use Illuminate\Database\Eloquent\Model;

class UserLikeProduct extends Model
{

    protected $table = 'log_user_like_product';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';
    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'modified_by';

    protected $fillable = [
        'id',
        'created_at',
        'modified_at',
        'description',
        'product_id',
        'user_id',
        'user_name',
        'product_id',
        'status',
        'deleted',
        'status_log',
        'published_at',
        'created_by',
        'modified_by'
    ];
}
