<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Tweet;

class TweetController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        // TODO: If we need infinite loop, we need to add pagination query

        $followingUserIdList = $this->stubMe()->following()->get()->pluck('id');

        return response()->json([
            'tweets' => Tweet::whereIn('user_id', $followingUserIdList)->with(['favorites', 'mentions', 'retweets', 'attachments'])->orderByDesc('created_at')->get()
        ]);
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
