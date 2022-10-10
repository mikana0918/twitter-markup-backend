<?php

namespace Tests\Feature\Controllers;

use App\Models\FavoriteTweet;
use App\Models\Tweet;
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

        $this->deleteJson('/api/tweets/favorites/' . $tweet->id)->assertStatus(200);

        $this->assertEquals(0, FavoriteTweet::where('tweet_id', $tweet->id)->where('user_id', User::all()->first()->id)->count());
    }
}
