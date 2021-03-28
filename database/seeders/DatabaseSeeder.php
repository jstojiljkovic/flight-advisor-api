<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory(['username' => 'admin'])->create();
        $admin = Role::factory(['name' => 'Admin'])->create();
        Role::factory(['name' => 'Regular'])->create();
        $user->roles()->attach($admin);
    }
}
