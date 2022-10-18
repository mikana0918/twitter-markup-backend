<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FollowedUser>
 */
class FollowedUserFactory extends Factory
{

    public function definition()
    {
        $allIds = User::all('id');

        $userId = $allIds->random();
        $otherUser = $allIds->filter(function($value) use ($userId) {
            return $value !== $userId;
        })->random();

        return [
            'user_id' => $userId,
            'followed_by_user_id' => $otherUser
        ];
    }
}
