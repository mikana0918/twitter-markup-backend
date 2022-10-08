<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;

class TweetControllerTest extends TestCase
{
    public function test_it_should_get_list()
    {
        $response = $this->getJson('/api/tweets');

        $response->assertStatus(200);
    }
}
