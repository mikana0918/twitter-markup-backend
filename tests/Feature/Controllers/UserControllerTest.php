<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function test_it_should_get_me()
    {
        $response = $this->getJson('/api/users/me');

        $response->assertStatus(200);
    }

    public function test_it_should_get_followings()
    {
        $response = $this->getJson('/api/users/followings');

        $response->assertStatus(200);
    }

    public function test_it_should_get_followers()
    {
        $response = $this->getJson('/api/users/followers');

        $response->assertStatus(200);
    }
}
