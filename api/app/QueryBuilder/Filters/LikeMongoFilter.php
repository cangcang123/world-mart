<?php

namespace App\QueryBuilder\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class LikeMongoFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property) : Builder
    {
        return $query->where($property, 'like', "%{$value}");
    }
}
