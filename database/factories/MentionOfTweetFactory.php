<?php

namespace Database\Factories;

use App\Models\Tweet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MentionOfTweet>
 */
class MentionOfTweetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'tweet_id' => Tweet::all()->random()->id,
            'mentioned_tweet_id' => Tweet::all()->random()->id,
        ];
    }
}
