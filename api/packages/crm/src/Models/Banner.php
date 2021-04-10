<?php

namespace SHOP\CRM\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{

    protected $table = 'app_banner';
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
        'url',
        'status',
        'deleted',
        'status_log',
        'created_by',
        'modified_by'
    ];
}
