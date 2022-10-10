<?php

namespace App\Http\Controllers;

use App\Models\FavoriteTweet;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Models\Tweet;

class TweetController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        // TODO: If we need infinite loop, we need to add pagination query

        $authUser = $this->stubMe();
        $followingUserIdList = $authUser->following()->get()->pluck('id');

        $q = Tweet::whereIn('user_id', $followingUserIdList);
        $retweets = $q->has('retweets')->get();
        $tweets = $q->with(['favorites', 'mentions', 'attachments'])->get();

        return response()->json([
            'tweets' => $retweets->concat($tweets)
        ]);
    }

    /**
     * @param int $tweetId
     * @return JsonResponse
     */
    public function addFavorite(int $tweetId): JsonResponse
    {
        $authUser = $this->stubMe();

        FavoriteTweet::updateOrCreate(
            ['user_id' => $authUser->id, 'tweet_id' => $tweetId],
            ['user_id' => $authUser->id, 'tweet_id' => $tweetId]
        );

        return response()->json();
    }

    /**
     * @param int $tweetId
     * @return JsonResponse
     */
    public function removeFavorite(int $tweetId): JsonResponse
    {
        // TODO: Remove soft delete column deleted_at
        $authUser = $this->stubMe();

        FavoriteTweet::where('tweet_id', $tweetId)->where('user_id', $authUser->id)->delete();

        return response()->json();
    }

    // TODO: define this
    public function retweet()
    {
//        if ($request->input('body')) {
//
//        }
    }

    /**
     * TODO: implement auth module and get auth user
     *
     * @return User
     */
    private function stubMe(): User
    {
        return User::all()->first();
    }
}
