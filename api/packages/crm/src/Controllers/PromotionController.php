<?php



namespace SHOP\CRM\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\QueryBuilder\Filters\WhereInFilter;
use SHOP\CRM\Models\Promotion;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PromotionController extends ApiController
{
    protected $model = Promotion::class;

    public function __construct()
    {
        $this->middleware('jwt.auth');

        $this->filter = [
            AllowedFilter::exact('id'),
            'created_at', 'modified_at',
            'desciption', 'name', 'start_date', 'end_date', 'value', 'code' , 'max_discount_price', 'min_order_price', 'note',
            'status', 'deleted', 'status_log', 'created_by', 'modified_by'
        ];

        $this->allowedSorts = ['id', 'created_at', 'desciption', 'start_date', 'end_date', 'value', 'code' , 'max_discount_price', 'min_order_price', 'note', 'name', 'modified_at', 'status', 'deleted', 'status_log', 'created_by', 'modified_by'];
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
