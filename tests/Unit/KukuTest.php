<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KukuTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    // http test->redirection (user shouldn't enter create if they haven't logged in;
    public function pageAccessTest()
    {
        $response = $this->get('/posts/create');

        $response->assertStatus(302);
    }

    public function testBasicExample()
    {
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json('POST', '/posts/create', ['title' => 'Dummy Blog', 'body'=>'dummy body']);

        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);
    }
}
