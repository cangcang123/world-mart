<?php

namespace SHOP\CRM\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use SHOP\CRM\Models\Size;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SizeController extends ApiController
{
    protected $model = Size::class;

    public function __construct()
    {
        $this->middleware('jwt.auth');

        $this->filter = [
            AllowedFilter::exact('id'),
            'created_at', 'modified_at',
            'desciption', 'name', 
            'status', 'deleted', 'status_log', 'created_by', 'modified_by'
        ];

        $this->allowedSorts = ['id', 'created_at', 'desciption', 'name', 'modified_at', 'status', 'deleted', 'status_log', 'created_by', 'modified_by'];
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
