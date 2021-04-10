<?php

namespace SHOP\CRM\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = 'category';
    protected $connection = 'mysql';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';
    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'modified_by';

    protected $fillable = [
        'id',
        'parent_id',
        'created_at',
        'modified_at',
        'name',
        'slug',
        'meta_title',
        'meta_content',
        'cover_photo',
        'image_url',
        'description',
        'status',
        'deleted',
        'status_log',
        'created_by',
        'modified_by'
    ];
}
