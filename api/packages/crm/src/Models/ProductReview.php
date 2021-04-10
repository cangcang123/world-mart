<?php

namespace SHOP\CRM\Models;

use Illuminate\Database\Eloquent\Model;
use App\Database\Eloquent\SoftDeletes;

class ProductReview extends Model
{
    use SoftDeletes;
    protected $table = 'product_review';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';
    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'modified_by';

    protected $fillable = [
        'id',
        'created_at',
        'modified_at',
        'title',
        'description',
        'product_id',
        'user_id',
        'user_name',
        'parent_id',
        'total_like',
        'total_dislike',
        'rating',
        'images',
        'status',
        'deleted',
        'status_log',
        'published_at',
        'created_by',
        'modified_by'
    ];
}
