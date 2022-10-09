<?php

namespace Tests\Unit\App\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\FollowingUser;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_attaches_following_users()
    {
        /** @var User $me */
        $me = User::factory()->create();

        /** @var User $me */
        $followingUser_1 = User::factory()->create();

        $me->following()->attach($followingUser_1);

        /** @var FollowingUser $followingUserOnDb */
        $followingUserOnDb = FollowingUser::where('user_id', $me->id)->where('following_user_id', $followingUser_1->id)->first();

        $this->assertEquals($followingUserOnDb->user_id, $me->id);
        $this->assertEquals($followingUserOnDb->following_user_id, $followingUser_1->id);
        $this->assertEquals(1, FollowingUser::where('user_id', $me->id)->count());
    }

    public function test_it_attaches_many_following_users()
    {
        /** @var User $me */
        $me = User::factory()->create();

        /** @var User $me */
        $followingUser_1 = User::factory()->create();
        /** @var User $me */
        $followingUser_2 = User::factory()->create();
        /** @var User $me */
        $followingUser_3 = User::factory()->create();

        $me->following()->attach($followingUser_1);
        $me->following()->attach($followingUser_2);
        $me->following()->attach($followingUser_3);

        $this->assertEquals(3, FollowingUser::where('user_id', $me->id)->count());
    }

    public function test_it_attaches_and_detaches_following_users()
    {
        /** @var User $me */
        $me = User::factory()->create();

        /** @var User $me */
        $followingUser_1 = User::factory()->create();
        /** @var User $me */
        $followingUser_2 = User::factory()->create();
        /** @var User $me */
        $followingUser_3 = User::factory()->create();

        $me->following()->attach($followingUser_1);
        $me->following()->attach($followingUser_2);
        $me->following()->attach($followingUser_3);

        $this->assertEquals(3, FollowingUser::where('user_id', $me->id)->count());

        $me->following()->detach($followingUser_1);
        $me->following()->detach($followingUser_2);
        $me->following()->detach($followingUser_3);

        $this->assertEquals(0, FollowingUser::where('user_id', $me->id)->count());
    }
}
