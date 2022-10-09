<?php

namespace Database\Seeders;

use App\Models\Tweet;
use App\Models\FavoriteTweet;
use App\Models\MentionOfTweet;
use App\Models\ReTweet;
use App\Models\TweetAttachment;
use Illuminate\Database\Seeder;

class TweetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Create default user.
     *
     * @return void
     */
    public function run()
    {
        Tweet::factory(20)->create();
        FavoriteTweet::factory(50)->create();
        MentionOfTweet::factory(50)->create();
        ReTweet::factory(50)->create();
        TweetAttachment::factory(50)->create();
    }
}
