<?php

namespace App\Policies;

use App\Models\User;
use App\Constants\Role;

class OfferPolicy {
    /**
     * Create a new policy instance.
     */
    public function check( User $user ) {
        return $user->role === Role::USER;
    }
}