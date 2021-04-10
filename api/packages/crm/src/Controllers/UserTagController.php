<?php

namespace SHOP\CRM\Controllers;

use App\Http\Controllers\ApiController;
use Spatie\QueryBuilder\AllowedFilter;
use SHOP\CRM\Models\UserTag;
use SHOP\Admin\Library\ZaloOA;

class UserTagController extends ApiController
{
    protected $model = UserTag::class;

    public function __construct()
    {
        $this->middleware('jwt.auth');

        $this->filter = [
            AllowedFilter::exact('id'),
            'name',
            'description',
            'status'
        ];

        $this->allowedSorts = [
            'id',
            'name',
            'description',
            'status'
        ];
    }

//    public function getTagsOfOA(Request $request) {
//        $zalo_oa = new ZaloOA(['oa_id' => '']);
//
//        return [
//            'success' => true,
//            'data' => '',
//        ];
//    }

}
