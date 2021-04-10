<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class ApiPaginateServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerMacro();
    }

    public function register()
    {

    }

    protected function registerMacro()
    {
        Builder::macro('apiPaginate', function (int $limit = 12) {
            $offset = max(0, (int) request()->input('offset'));
            if (request()->has('limit')) {
                $_limit = (int) request()->input('limit');
                $limit = $_limit > 0 ? $_limit : $limit;
            }

            $total = $this->count();

            $entries = $this->limit($limit)->offset($offset)->get();
            $currentPage = ceil(($offset + 1) / $limit);
            $totalPages = ceil($total / $limit);
            $first = min($offset + 1, $total);
            $last = min($total, $offset + $limit);

            return [
                'totalCount' => $total,
                'pageInfo' => [
                    'perPage' => $limit,
                    'currentPage' => $currentPage,
                    'totalPages' => $totalPages,
                    'first' => $first,
                    'last' => $last,
                ],
                'entries' => $entries,
            ];
        });
    }
}