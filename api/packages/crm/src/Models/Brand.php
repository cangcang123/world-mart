<?php

namespace SHOP\CRM\Models;

use Illuminate\Database\Eloquent\Model;
use SHOP\Admin\Models\Country;

class Brand extends Model
{

    protected $table = 'brand';
    protected $connection = 'mysql';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modified_at';
    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'modified_by';

    protected $fillable = [
        'id',
        'created_at',
        'modified_at',
        'name',
        'slug',
        'country',
        'logo',
        'description',
        'distributor',
        'distributor_description',
        'status',
        'deleted',
        'status_log',
        'created_by',
        'modified_by'
    ];

    protected $with = [
        'countryinfo',
        // 'products'
    ];

    protected $withCount = [
        'products'
    ];

    public function countryinfo(){
        return $this->hasOne(Country::class,'iso','country');
    }

    public function products(){
        return $this->hasMany(Product::class,'brand')->where('product.status',1);
    }
}
