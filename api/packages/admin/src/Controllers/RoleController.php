<?php

namespace SHOP\Admin\Controllers;

use App\Http\Controllers\ApiController;
use SHOP\Admin\Models\AdminRole;

class RoleController extends ApiController
{
    protected $model = AdminRole::class;

    public $filter = ['name', 'description', 'status'];

    public function __construct()
    {
        $this->middleware('jwt.auth');
    }
}
