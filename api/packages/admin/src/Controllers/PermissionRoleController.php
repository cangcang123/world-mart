<?php

namespace SHOP\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use SHOP\Admin\Models\AdminPermissionRole;

class PermissionRoleController extends ApiController
{
    protected $model = AdminPermissionRole::class;

    public $filter = ['role_id', 'resource', 'is_publish', 'status'];

    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

//    public function update(Request $request, $id)
//    {
//        $this->authorize('update', $this->model);
//        $permissions = json_encode($request->input('permissions'));
//        $request->merge(['permissions' => $permissions]);
//        $entry = $this->model::findOrFail($id);
//        $entry->update($request->only($entry->getFillable()));
//        return $entry;
//    }
}
