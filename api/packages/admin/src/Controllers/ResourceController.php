<?php

namespace SHOP\Admin\Controllers;

use App\Http\Controllers\ApiController;
use SHOP\Admin\Models\AdminResource;

class ResourceController extends ApiController
{
    protected $model = AdminResource::class;

    public $filter = ['package_id', 'name'];

    public function __construct()
    {
        $this->middleware('jwt.auth');
    }
}
