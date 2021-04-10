<?php



namespace SHOP\CRM\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\QueryBuilder\Filters\WhereInFilter;
use SHOP\CRM\Models\UserPromotion;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UserPromotionController extends ApiController
{
    protected $model = UserPromotion::class;

    public function __construct()
    {
        $this->middleware('jwt.auth');

        $this->filter = [
            AllowedFilter::exact('id'),
            'created_at',
            'modified_at',
            'user_id',
            'type', // 1 => order , 2 => product
            'code',
            'is_public', // 1 => public, 2 => private
            'start_date',
            'end_date',
            'discount_value', // VND
            'min_commission_fee', // VND
            'product_id',
            'max_use_time',
            'used_time',
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
            'user_id',
            'type', // 1 => order , 2 => product
            'code',
            'is_public', // 1 => public, 2 => private
            'start_date',
            'end_date',
            'discount_value', // VND
            'min_commission_fee', // VND
            'product_id',
            'max_use_time',
            'used_time',
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
                'name',
            ])
            ->count();
    }
}
