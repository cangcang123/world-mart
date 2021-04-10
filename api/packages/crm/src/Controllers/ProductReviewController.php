<?php

namespace SHOP\CRM\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Spatie\QueryBuilder\AllowedFilter;
use SHOP\CRM\Models\ProductReview;
use Spatie\QueryBuilder\QueryBuilder;

class ProductReviewController extends ApiController
{
    protected $model = ProductReview::class;

    public function __construct()
    {
        $this->middleware('jwt.auth');

        $this->filter = [
            AllowedFilter::exact('id'),
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
            'status',
            'deleted',
            'status_log',
            'published_at',
            'created_by',
            'modified_by'
        ];

        $this->allowedSorts = [
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
            'status',
            'deleted',
            'status_log',
            'published_at',
            'created_by',
            'modified_by'
        ];
    }

    public function count(Request $request)
    {
        $this->authorize('count', [$this->model, $request]);
        return QueryBuilder::for($this->model)
            ->allowedFilters([
                'name',
            ])
            ->count();
    }
}
