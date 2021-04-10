<?php

namespace SHOP\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class AdminResource extends Model
{
    protected $table = 'admin_resources';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';
    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'modified_by';

    protected $fillable = [
        'package_id',
        'name',
        'is_publish',
        'state',
        'status',
    ];
}
