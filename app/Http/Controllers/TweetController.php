<?php

namespace App\Http\Controllers;

use App\Models\FavoriteTweet;
use App\Models\ReTweet;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
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
        // TODO: Let's add test for the case that tweet has every relationships

        $authUser = $this->stubMe();
        $followingUserIdList = $authUser->following()->get()->pluck('id');

        $tweets = Tweet::whereIn('user_id', $followingUserIdList)
            ->with('attachments')
            ->with(['retweets' => function(Builder $q) use ($followingUserIdList) {
                return $q->whereIn('user_id', $followingUserIdList);
            }])
            ->withCount('favorites')
            ->withCount('mentions')
            ->get();

        return response()->json([
            'tweets' => $tweets
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

    /**
     * @param CreateTweetRequest $request
     * @param int $targetTweetId
     * @return JsonResponse
     */
    public function retweet(CreateTweetRequest $request, int $targetTweetId): JsonResponse
    {
        $validated = $request->validated();

        $authUser = $this->stubMe();

        $tweet = Tweet::create([
            'user_id' => $authUser->id,
            'body' => $validated['body']
        ]);

        $reTweet = ReTweet::create([
            'tweet_id' => $targetTweetId,
            're_tweet_id' => $tweet->id
        ]);

        return response()->json([
            'tweet' => $tweet,
            'retweet' => $reTweet
        ]);
    }

    /**
     * @param int $targetTweetId
     * @return JsonResponse
     */
    public function removeTweet(int $targetTweetId): JsonResponse
    {
        // TODO: Let's add test for the case that tweet has every relationships
        $record = Tweet::find($targetTweetId);

        // TODO: We may need to remove everything attached
        $record->retweets()->detach();
        $record->mentions()->delete();

        $record->delete();

        return response()->json();
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
