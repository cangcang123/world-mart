<?php

namespace SHOP\CRM\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use SHOP\CRM\Models\Category;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Str;

class CategoryController extends ApiController
{
    protected $model = Category::class;

    public function __construct()
    {
        $this->middleware('jwt.auth');

        $this->filter = [
            AllowedFilter::exact('id'),
            'created_at', 'modified_at',
            'desciption', 'name',
            'meta_title',
            'meta_content',
            'slug',
            'parent_id',
            'cover_photo',
            'image_url',
            'status', 'deleted', 'status_log', 'created_by', 'modified_by'
        ];

        $this->allowedSorts = ['id', 'created_at','parent_id', 'desciption', 'name', 'meta_title', 'meta_content', 'slug', 'cover_photo', 'image_url', 'modified_at', 'status', 'deleted', 'status_log', 'created_by', 'modified_by'];
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

    public function create(Request $request) {
        $this->authorize('create', [$this->model, $request]);
        $params = $request->all();
        if(empty($params['slug'])) {
            $params['slug'] = Str::slug($params['name']);
        }
        $created = $this->model::create($params);
        if ($created) return response($created, 200);
        return response([], 400);
    }
}
