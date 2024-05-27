<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Offer;
use App\Constants\Role;

class OfferPolicy {
    /**
     * Create a new policy instance.
     */
    public function create( User $user ) {
        return $user->role === Role::USER;
    }

    public function update( User $user, Offer $offer ) {
        return $user->role === Role::ADMIN ||
            ( $user->role === Role::USER && $user->id === $offer->seller_id );
    }
}