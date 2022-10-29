<?php

namespace Database\Seeders;

use App\Models\FollowedUser;
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
        (new DefaultUserSeeder())->run();
        (new FollowingUserSeeder())->run();
        (new FollowedUserSeeder())->run();
        (new TweetSeeder())->run();
    }
}
