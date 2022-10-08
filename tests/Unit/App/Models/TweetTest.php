<?php

namespace Tests\Unit\App\Models;

use App\Models\MentionOfTweet;
use App\Models\ReTweet;
use App\Models\Tweet;
use App\Models\FavoriteTweet;
use App\Models\TweetAttachment;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TweetTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_many_favorites()
    {
        $tweet = Tweet::factory()->create();
        $favorites = FavoriteTweet::factory()->count(3)->create([
            'tweet_id' => $tweet->id
        ]);

        $this->assertEquals(3, count($favorites));
        // Check inverse relation
        $this->assertEquals($favorites->first()->tweet_id, $tweet->id);
    }

    public function test_it_has_many_mentions()
    {
        $tweet = Tweet::factory()->create();
        $mentionsOfTweet = MentionOfTweet::factory()->count(3)->create([
            'tweet_id' => $tweet->id
        ]);

        $this->assertEquals(3, count($mentionsOfTweet));
        // Check inverse relation
        $this->assertEquals($mentionsOfTweet->first()->tweet_id, $tweet->id);
    }

    public function test_it_has_many_retweets()
    {
        $tweet = Tweet::factory()->create();
        $user = User::factory()->create();
        $retweets = ReTweet::factory()->count(3)->create([
            'tweet_id' => $tweet->id,
            're_tweet_by_user_id' => $user->id
        ]);

        $this->assertEquals(3, count($retweets));
        // Check inverse relation
        $this->assertEquals($retweets->first()->tweet_id, $tweet->id);
    }

    public function test_it_has_many_attachments()
    {
        $tweet = Tweet::factory()->create();
        $attachments = TweetAttachment::factory()->count(3)->create([
            'tweet_id' => $tweet->id,
        ]);

        $this->assertEquals(3, count($attachments));
        // Check inverse relation
        $this->assertEquals($attachments->first()->tweet_id, $tweet->id);
    }
}
