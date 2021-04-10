<?php

namespace SHOP\CRM\Models;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class LogExportFile extends Model
{
    use Userstamps;

    protected $table = 'log_export_files';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';
    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'modified_by';

    protected $fillable = [
        'name',
        'state',
        // 'publish_time',
        'path',
        'oa_id',
        'total_download',
        'status',
        'status_log',
        'extension',
        'type'
    ];
}
