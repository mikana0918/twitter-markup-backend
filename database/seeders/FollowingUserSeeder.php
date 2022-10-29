<?php

namespace Database\Seeders;

use App\Models\FollowingUser;
use Illuminate\Database\Seeder;

class FollowingUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Create default user.
     *
     * @return void
     */
    public function run()
    {
        FollowingUser::factory(50)->create();
    }
}
