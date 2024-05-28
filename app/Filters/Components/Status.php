<?php

declare ( strict_types = 1 );

namespace App\Filters\Components;

use Closure;
use App\Filters\Components\FilterInterface;

class Status implements FilterInterface {
    public function handle( array $content, Closure $next ): mixed {
        if ( isset( $content['params']['status'] ) ) {
            $content['builder']->where( 'status', $content['params']['status'] );
        }

        return $next( $content );
    }
}