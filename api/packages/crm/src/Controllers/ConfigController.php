<?php

namespace SHOP\CRM\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\ApiController;
use SHOP\CRM\Models\Config;

class ConfigController extends ApiController
{
    protected $model = Config::class;

    public $filter = ['name', 'description', 'key', 'value'];

    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
//    public function create(Request $request)
//    {
//        $this->authorize('create', $this->model);
//
//        try {
//            $key = $request->input('key');
//            $value = $request->input('value');
//            Redis::set($key, $value);
//        } catch (\Exception $e) {
//
//        }
//
//        return $this->model::create($request->all());
//    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
//    public function update(Request $request, $id)
//    {
//        $this->authorize('update', $this->model);
//        $entry = $this->model::findOrFail($id);
//        $entry->update($request->only($entry->getFillable()));
//
//        try {
//            $key = $request->input('key');
//            $value = $request->input('value');
//            Redis::set($key, $value);
//        } catch (\Exception $e) {
//
//        }
//
//        return $entry;
//    }
}
