<?php

declare(strict_types=1);

namespace App\Filters\Components;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class Category implements FilterInterface
{
    public function handle(array $content, Closure $next): mixed
    {
        if (isset($content['params']['category'])) {
            $content['builder']->whereHas('categories',
                function (Builder $query) use ($content) {
                    $query->where('id', $content['params']['category']);
                });
        }

        return $next($content);
    }
}
