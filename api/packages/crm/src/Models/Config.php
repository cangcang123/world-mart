<?php

namespace SHOP\CRM\Models;

use App\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Config extends Model
{
    use Userstamps, SoftDeletes;

    protected $table = 'crm_configs';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';
    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'modified_by';

    protected $fillable = [
        'name',
        'description',
        'key',
        'value',
        'status',
        'deleted',
        'status_log',
    ];
}