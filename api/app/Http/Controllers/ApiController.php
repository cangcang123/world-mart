<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use SHOP\Admin\Jobs\AdminExportFile;
use SHOP\Admin\Controllers\FileUploadController;

/**
 * Class ApiController
 * @package App\Http\Controllers
 */
abstract class ApiController extends Controller
{
    public $filter = [];
    public $allowedSorts = [];

    public function list(Request $request)
    {
        $this->authorize('list', [$this->model, $request]);
        $items = QueryBuilder::for($this->model)
            ->allowedFilters($this->filter)
            ->allowedSorts($this->allowedSorts);
        return $items->apiPaginate();
    }

    public function create(Request $request)
    {
        $this->authorize('create', [$this->model, $request]);
        return $this->model::create($request->all());
    }

    public function detail(Request $request, $id)
    {
        $this->authorize('detail', [$this->model, $request]);
        return $this->model::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('update', [$this->model, $request]);
        $entry = $this->model::findOrFail($id);
        $entry->update($request->only($entry->getFillable()));
        return $entry;
    }

    public function delete(Request $request, $id)
    {
        $this->authorize('delete', [$this->model, $request]);
        $entry = $this->model::findOrFail($id);
        $entry->delete();
        return $entry;
    }

    public function trash(Request $request)
    {
        $this->authorize('trash', [$this->model, $request]);
        $items = QueryBuilder::for($this->model)
            ->allowedFilters($this->filter)
            ->allowedSorts($this->allowedSorts)
            ->onlyTrashed();
        return $items->apiPaginate();
    }

    public function count(Request $request)
    {
        $this->authorize('count', [$this->model, $request]);
        return QueryBuilder::for($this->model)
            ->allowedFilters($this->filter)
            ->count();
    }

    public function distinct(Request $request, $field)
    {
        $this->authorize('list', [$this->model, $request]);
        return QueryBuilder::for($this->model)
            ->select($field)
            ->allowedFilters($this->filter)
            ->distinct()
            ->get()
            ->map(function($entry) use($field) {
                return $entry->{$field};
            })
            ->toArray();
    }

    public function export(Request $request)
    {
        $this->authorize('export', [$this->model, $request]);
        $condition = [
            'request_filter' => $request->input('filter'),
            'request_sort'   => $request->input('sort'),
            'select_fields'  => $request->input('fields'),
            'type'           => $request->input('type'),
            'time'           => $request->input('time'),
            'filter'         => $this->filter,
            'sort'           => $this->allowedSorts
        ];

        dispatch(new AdminExportFile($this->model, $condition));

        return [
            'status' => true
        ];
    }

    public function import(Request $request)
    {
        $this->authorize('import', [$this->model, $request]);
        $table_name = call_user_func([new $this->model, 'getTable']);
        return FileUploadController::uploadFile($request, $table_name);
    }

}
