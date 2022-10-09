<?php

namespace App\Http\Controllers;

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
        return response()->json([
            'tweets' => Tweet::with(['favorites', 'mentions', 'retweets', 'attachments'])->get()
        ]);
    }
}
