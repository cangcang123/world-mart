<?php

namespace SHOP\CRM\Models;

use Illuminate\Database\Eloquent\Model;

class UserReferral extends Model
{

    protected $table = 'user_referral';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';
    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'modified_by';

    protected $fillable = [
        'id',
        'created_at',
        'modified_at',
        'user_share_code',
        'user_receive_code',
        'user_share_id',
        'user_receive_id',
        'status',
        'deleted',
        'status_log',
        'created_by',
        'modified_by'
    ];
}
