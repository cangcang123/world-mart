<?php

namespace App\QueryBuilder\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class ExistMongoFilter implements Filter
{
    protected $field;

    public function __construct($field = '')
    {
        $this->field = $field;
    }

    public function __invoke(Builder $query, $value, string $property) : Builder
    {
        if ($this->field) {
            $property = $this->field;
        }

        if($value == true) {
            return $query->whereNotNull($property)->where($property, '<>', '');
        }

        return $query;
    }
}
