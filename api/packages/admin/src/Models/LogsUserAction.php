<?php

namespace SHOP\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class LogsUserAction extends Model
{
    protected $table = 'admin_logs_user_actions';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';
    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'modified_by';

    protected $fillable = [
        'id',
        'role_id',
        'user_id',
        'username',
        'resource',
        'action',
        'ip',
        'platform',
        'browser',
        'user_agent'
    ];
}
