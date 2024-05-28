<?php

declare ( strict_types = 1 );

namespace App\Filters\Components;

use Closure;
use App\Filters\Components\FilterInterface;

class Title implements FilterInterface {
    public function handle( array $content, Closure $next ): mixed {
        if ( isset( $content['params']['title'] ) ) {
            $value = $content['params']['title'];

            $content['builder']->where( 'title', 'like', '%'.$value.'%' );
        }

        return $next( $content );
    }
}