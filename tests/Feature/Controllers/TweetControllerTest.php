<?php

namespace Tests\Feature\Controllers;

use App\Models\FavoriteTweet;
use App\Models\MentionOfTweet;
use App\Models\ReTweet;
use App\Models\Tweet;
use App\Models\TweetAttachment;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;

class TweetControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_should_show_tweet()
    {
        /** @var Tweet $tweet */
        $tweet = Tweet::factory()->create();

        $response = $this->getJson('/api/tweets/' . $tweet->id);

        $response->assertStatus(200);

        $response->assertJson(fn(AssertableJson $json) => $json->has('tweet')->where('tweet.id', $tweet->id)
        );
    }

    public function test_it_should_get_list()
    {
        $response = $this->getJson('/api/tweets');

        $response->assertStatus(200);
    }

    public function test_it_should_store_tweet()
    {
        $body = 'sample tweet body';

        $response = $this->postJson('/api/tweets', [
            'body' => $body
        ]);

        $response->assertStatus(200);

        $response->assertJson(fn(AssertableJson $json) => $json->has('tweet')->where('tweet.body', $body));
    }

    public function test_it_should_delete_tweet()
    {
        /** @var User $authUser */
        $authUser = User::factory()->create();

        /** @var Tweet $tweet */
        $tweet = Tweet::factory()->create([
            'user_id' => $authUser->id
        ]); // The Tweet to delete

        // Attach Favorite Tweet
        /** @var FavoriteTweet $favByOtherUser */
        $favByOtherUser = FavoriteTweet::factory()->create([
            'tweet_id' => $tweet->id,
            'user_id' => $authUser->id
        ]);

        // Attach ReTweet
        /** @var ReTweet $reTweetByOtherUser */
        $reTweetByOtherUser = ReTweet::factory()->create([
            'tweet_id' => $tweet->id,
        ]);

        // Attach Mention
        /** @var Tweet $mentionByOtherUser */
        $mentionByOtherUser = Tweet::factory()->create();
        /** @var Tweet $mentionedTweet */
        $mentionedTweet = Tweet::factory()->create();
        /** @var MentionOfTweet $mentionByOtherUser */
        $mentionByOtherUser = MentionOfTweet::factory()->create([
            'tweet_id' => $mentionByOtherUser->id,
            'mentioned_tweet_id' => $mentionedTweet->id
        ]);

        // Attach Attachments
        /** @var TweetAttachment $attachment */
        $attachment = TweetAttachment::factory()->create([
            'tweet_id' => $tweet->id
        ]);

        $response = $this->deleteJson("/api/tweets/{$tweet->id}");

        $response->assertStatus(200);

        // Other record should be deleted
        // Favorite record should be removed
        $this->assertEquals(null, FavoriteTweet::find($favByOtherUser->id));
        // ReTweet record should be removed
        $this->assertEquals(null, ReTweet::find($reTweetByOtherUser->id));
        // Attachment record should be removed
        $this->assertEquals(null, TweetAttachment::find($attachment->id));

        // Mention should exist(since the mention is not the removed Tweet)
        $this->assertNotNull(MentionOfTweet::find($mentionByOtherUser->id));
    }

    public function test_it_should_store_re_tweet()
    {
        $body = 'sample re_tweet body';

        /** @var Tweet $reTweetTarget */
        $reTweetTarget = Tweet::factory()->create();

        $response = $this->postJson('/api/tweets/retweet/' . $reTweetTarget->id, [
            'body' => $body
        ]);

        $response->assertStatus(200);

        $response->assertJson(
            fn(AssertableJson $json) => $json
                ->has('tweet')
                ->where('tweet.body', $body)
                ->has('retweet')
                ->where('retweet.tweet_id', $reTweetTarget->id)
        );
    }

    // TODO: Add those TODO tests

    public function test_it_can_favorite_tweet()
    {
        User::factory(2)->create();
        /** @var Tweet $tweet */
        $tweet = Tweet::factory()->create();

        $response = $this->postJson('/api/tweets/favorites/' . $tweet->id);

        $response->assertStatus(200);
    }

    public function test_it_can_remove_favorite()
    {
        /** @var Tweet $tweet */
        $tweet = Tweet::factory()->create();

        FavoriteTweet::factory()->create([
            'tweet_id' => $tweet->id,
            'user_id' => User::all()->first()->id // TODO: Once we have auth, this should be removed with auth user
        ]);

        $this->assertEquals(1, FavoriteTweet::where('tweet_id', $tweet->id)->where('user_id', User::all()->first()->id)->count());

        $this->postJson('/api/tweets/favorites/' . $tweet->id)->assertStatus(200);

        $this->assertEquals(0, FavoriteTweet::where('tweet_id', $tweet->id)->where('user_id', User::all()->first()->id)->count());
    }
}
