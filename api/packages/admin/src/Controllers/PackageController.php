<?php

namespace SHOP\Admin\Controllers;

use App\Http\Controllers\ApiController;
use SHOP\Admin\Models\AdminPackage;

class PackageController extends ApiController
{
    protected $model = AdminPackage::class;

    public $filter = ['name'];

    public function __construct()
    {
        $this->middleware('jwt.auth');
    }
}
