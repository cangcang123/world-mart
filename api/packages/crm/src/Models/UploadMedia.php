<?php

namespace SHOP\CRM\Models;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class UploadMedia extends Model
{
    use Userstamps;

    protected $table = 'upload_medias';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';
    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'modified_by';
}
