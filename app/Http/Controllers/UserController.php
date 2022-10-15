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
     * TODO: This method should return following based on authorized user
     * @param Request $request
     * @param int $userId
     * @return JsonResponse
     */
    public function followUserById(Request $request, int $userId): JsonResponse
    {
        // TODO: User can not follow own
        // TODO: User can not follow with no existing userId including deleted user
        // TODO: I think this will always return 2xx
        $authUser = $this->stubMe();

        $userToFollow = User::find($userId);

        $authUser->following()->attach($userToFollow);

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
