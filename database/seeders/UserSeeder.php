<?php

namespace Database\Seeders;

use App\Models\User;
use App\Constants\Role;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        User::factory()->create( [
            'name'  => "Admin",
            'email' => "admin@test.com",
            'role'  => Role::ADMIN,
        ] );

        User::factory()->create( [
            'name'  => "Seller",
            'email' => "seller@test.com",
        ] );
    }
}