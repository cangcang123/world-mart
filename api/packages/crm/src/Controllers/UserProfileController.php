<?php

namespace SHOP\CRM\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\QueryBuilder\Filters\WhereInFilter;
use App\QueryBuilder\Filters\ExistMongoFilter as ExistMysqlFilter;
use SHOP\CRM\Models\UserProfile;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Redis;

class UserProfileController extends ApiController
{
    protected $model = UserProfile::class;
    private $expire = 1800; // 30 mins

    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => 'scheduleProfiles']);

        $this->filter = [
            AllowedFilter::exact('id'),
            AllowedFilter::exact('province_code'),
            'created_at',
            'modified_at',
            'provider',
            'provider_id',
            'full_name',
            'avatar',
            'dob',
            'gender',
            'phone',
            'phone_code',
            'password',
            'email',
            'address',
            'district_code',
            'ward_code',
            'province',
            'district',
            'ward',
            'username',
            'last_login',
            'referral_code',
            'referral_user',
            'user_invited',
            'member_type',
            'identification',
            'banking_info',
            'wallet',
            'token',
            'rating',
            'status',
            'deleted',
            'status_log',
            'created_by',
            'modified_by'
        ];

        $this->allowedSorts = [        
            'id',
            'created_at',
            'modified_at',
            'provider',
            'provider_id',
            'full_name',
            'avatar',
            'dob',
            'gender',
            'phone',
            'phone_code',
            'password',
            'email',
            'address',
            'province_code',
            'district_code',
            'ward_code',
            'province',
            'district',
            'ward',
            'username',
            'last_login',
            'referral_code',
            'referral_user',
            'user_invited',
            'identification',
            'wallet',
            'banking_info',
            'member_type',
            'token',
            'is_new',
            'sub_description',
            'rating',
            'status',
            'deleted',
            'status_log',
            'created_by',
            'modified_by'
        ];
    }

    public function count(Request $request)
    {
        $this->authorize('count', [$this->model, $request]);
        return QueryBuilder::for($this->model)
            ->allowedFilters([
                AllowedFilter::custom('gender', new WhereInFilter),
                AllowedFilter::custom('province', new WhereInFilter),
                AllowedFilter::custom('member_type', new WhereInFilter),
            ])
            ->count();
    }

    public function list(Request $request)
    {
        $this->authorize('list', [$this->model, $request]);
        $items = QueryBuilder::for($this->model)
            ->allowedFilters($this->filter)
            ->allowedSorts($this->allowedSorts)
            ->apiPaginate();

        if (is_object($items['entries']) && count($items['entries']) > 0) {

        }
        return $items;
    }

    public function detail(Request $request, $id)
    {
        $this-> authorize('detail', [$this->model, $request]);
        $profile = $this->model::where('id', $id)->first();

        if (is_null($profile)) {
            return [];
        }
        $profile = $profile->toArray();

        return $profile;
    }
}
