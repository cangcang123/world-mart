<?php
/**
 * Created by Kinh Luan.
 * Date: 10/24/2019
 * Time: 4:22 PM
 */

namespace App\QueryBuilder\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class ExactNumberWhereInMongoFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property) : Builder
    {

        return $query->whereIn($property, array_map(function ($item){
            return floatval($item);
        }, $value));
    }
}
