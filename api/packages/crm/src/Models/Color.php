<?php

namespace SHOP\CRM\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{

    protected $table = 'color';
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
        'color_code',
        'description',
        'status',
        'deleted',
        'status_log',
        'created_by',
        'modified_by'
    ];
}
