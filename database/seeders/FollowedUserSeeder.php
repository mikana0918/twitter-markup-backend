<?php

namespace Database\Seeders;

use App\Models\FollowedUser;
use Illuminate\Database\Seeder;

class FollowedUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Create default user.
     *
     * @return void
     */
    public function run()
    {
        FollowedUser::factory(50)->create();
    }
}
