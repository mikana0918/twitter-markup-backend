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
}
