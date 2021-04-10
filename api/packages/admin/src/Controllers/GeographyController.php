<?php

namespace SHOP\Admin\Controllers;

use App\Http\Controllers\Controller;
use SHOP\Admin\Models\Province;
use SHOP\Admin\Models\Country;
use SHOP\Admin\Models\District;
use SHOP\Admin\Models\Ward;

class GeographyController extends Controller
{
    public function provinces()
    {
        return Province::select(['code', 'name', 'class'])
            ->where('deleted', 0)
            ->get();
    }

    public function countries()
    {
        return Country::select(['iso', 'country_name'])
            ->get();
    }

    public function districts($province_code)
    {
        return District::select(['code', 'name', 'class', 'province_code', 'province_name'])
            ->where('province_code', $province_code)
            ->get();
    }

    public function wards($district_code)
    {
        return Ward::select(['code', 'name', 'class', 'district_code', 'district_name', 'province_code', 'province_name'])
            ->where('district_code', $district_code)
            ->get();
    }
}