<?php

namespace SHOP\Admin\Controllers;

use App\Http\Controllers\ApiController;
use SHOP\Admin\Models\LogsUserAction;

class LogsUserActionController extends ApiController
{
    protected $model = LogsUserAction::class;

    public $filter = [
        'role_id',
        'user_id',
        'username',
        'resource',
        'action',
        'ip',
        'platform',
        'browser'
    ];

    public $allowedSorts = [
        'id',
    ];

    public function __construct()
    {
        $this->middleware('jwt.auth');
    }
}
