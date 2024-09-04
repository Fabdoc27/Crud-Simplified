<?php

declare(strict_types=1);

namespace App\Filters\Components;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class Location implements FilterInterface
{
    public function handle(array $content, Closure $next): mixed
    {
        if (isset($content['params']['location'])) {
            $content['builder']->whereHas('locations',
                function (Builder $query) use ($content) {
                    $query->where('id', $content['params']['location']);
                });
        }

        return $next($content);
    }
}
