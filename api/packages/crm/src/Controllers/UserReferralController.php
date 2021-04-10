<?php

namespace SHOP\CRM\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Spatie\QueryBuilder\AllowedFilter;
use SHOP\CRM\Models\UserReferral;
use Spatie\QueryBuilder\QueryBuilder;

class UserReferralController extends ApiController
{
    protected $model = UserReferral::class;

    public function __construct()
    {
        $this->middleware('jwt.auth');

        $this->filter = [
            AllowedFilter::exact('id'),
            'user_share_id',
            'user_receive_id',
            'user_receive_code',
            'user_receive_code',
        ];

        $this->allowedSorts = [
            'id',
            'user_share_id',
            'user_receive_id',
            'user_receive_code',
            'user_receive_code',
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
