<?php

namespace SHOP\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class AdminFieldCustom extends Model
{
    protected $table = 'admin_field_customs';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';
    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'modified_by';

    protected $fillable = [
        'user_id',
        'entry',
        'display_fields',
        'status',
        'deleted',
        'status_log',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'display_fields' => 'array',
    ];
}
