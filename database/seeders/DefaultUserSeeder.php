<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Create default user.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->create();
    }
}
