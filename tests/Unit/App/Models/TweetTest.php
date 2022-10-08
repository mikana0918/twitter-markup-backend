<?php

namespace Tests\Unit\App\Models;

use App\Models\Tweet;
use App\Models\FavoriteTweet;
use Tests\TestCase;

class TweetTest extends TestCase
{
    public function test_it_has_many_favorites() {
        $tweet = Tweet::factory()->create();
        $favorites = FavoriteTweet::factory()->count(3)->create([
            'tweet_id' => $tweet->id
        ]);

        $this->assertEquals(3, count($favorites));
    }
}
