<?php

namespace SHOP\CRM\Models;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class LogImportFile extends Model
{
    use Userstamps;

    protected $table = 'log_import_files';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';
    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'modified_by';

    protected $fillable = [
        'name',
        'state',
        'import_time',
        'path',
        'total_rows',
        'status',
        'status_log',
        'extension',
        'description',
        'columns',
        'table'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'import_time',
    ];
}
