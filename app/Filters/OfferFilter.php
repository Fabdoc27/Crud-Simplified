<?php

namespace App\Filters;
use App\Filters\BaseFilter;
use App\Filters\Components\Title;
use App\Filters\Components\Status;
use App\Filters\Components\Category;
use App\Filters\Components\Location;

class OfferFilter extends BaseFilter {
    protected function getFilters(): array {
        return [
            Status::class,
            Category::class,
            Location::class,
            Title::class,
        ];
    }
}