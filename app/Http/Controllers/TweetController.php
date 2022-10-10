<?php

namespace App\Http\Controllers;

use App\Models\FavoriteTweet;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Models\Tweet;
use App\Http\Requests\CreateTweetRequest;

class TweetController extends Controller
{
    /**
     * Lists tweets for timeline
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
     * Shows tweets for given user
     * @param int $tweetId
     * @return JsonResponse
     */
    public function show(int $tweetId): JsonResponse
    {
        $tweet = Tweet::find($tweetId);

        return response()->json([
            'tweet' => $tweet
        ]);
    }

    /**
     * Post new tweet
     * @param CreateTweetRequest $request
     * @return JsonResponse
     */
    public function store(CreateTweetRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $authUser = $this->stubMe();

        $tweet = Tweet::create([
            'user_id' => $authUser->id,
            'body' => $validated['body']
        ]);

        return response()->json([
            'tweet' => $tweet
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
    public function retweet(Request $request, int $tweetId)
    {

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
