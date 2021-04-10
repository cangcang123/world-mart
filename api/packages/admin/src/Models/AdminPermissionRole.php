<?php

namespace SHOP\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class AdminPermissionRole extends Model
{
    protected $table = 'admin_permission_roles';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';
    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'modified_by';

    protected $fillable = [
        'role_id',
        'resource',
        'permissions',
        'is_publish',
        'state',
        'status',
    ];
}
