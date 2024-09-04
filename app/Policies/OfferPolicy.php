<?php

namespace App\Policies;

use App\Constants\Role;
use App\Models\Offer;
use App\Models\User;

class OfferPolicy
{
    /**
     * Create a new policy instance.
     */
    public function viewAll(User $user)
    {
        return $user->role === Role::ADMIN;
    }

    public function viewMine(User $user)
    {
        return $user->role === Role::USER;
    }

    public function create(User $user)
    {
        return $user->role === Role::USER;
    }

    public function update(User $user, Offer $offer)
    {
        return $user->role === Role::ADMIN ||
            ($user->role === Role::USER && $user->id === $offer->seller_id);
    }
}
