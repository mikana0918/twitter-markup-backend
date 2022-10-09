<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * TODO: This method should return following based on authorized user
     * @param Request $request
     * @return JsonResponse
     */
    public function me(Request $request): JsonResponse
    {
        $authUser = $this->stubMe();

        return response()->json([
            'user' => $authUser
        ]);
    }

    /**
     * TODO: This method should return following based on authorized user
     * @param Request $request
     * @return JsonResponse
     */
    public function followingList(Request $request): JsonResponse
    {
        $authUser = $this->stubMe();

        return response()->json([
            'followings' => $authUser->following()->get()
        ]);
    }

    /**
     * TODO: This method should return following based on authorized user
     * @param Request $request
     * @return JsonResponse
     */
    public function followersList(Request $request): JsonResponse
    {
        $authUser = $this->stubMe();

        return response()->json([
            'followers' => $authUser->followers()->get()
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
