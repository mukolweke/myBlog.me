<?php

namespace Tests\Unit;

use App\Post;
use App\Repository\User\UserRepository;
use App\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KukuTest extends TestCase
{

    use RefreshDatabase;

//    creates user and logs them in
    public function loginUser()
    {
        $user = factory(User::class)->create();

        Auth::login($user, true);

        return Auth::user();
    }

    // http test->redirection (user shouldn't enter create if they haven't logged in;
    public function pageAccessTest()
    {

        $user = $this->loginUser();

        $response = $this->get('/posts/create');

        $response->assertStatus(302);

        dd(Auth::user());

    }


public function testIfFetchesHighestPriority()
{
    $user = $this->loginUser();
    // assumption made
    factory(Post::class,3)->create();

    factory(Post::class)->create(['priority'=>'3']);

    $important_post = factory(Post::class)->create(['priority'=>'5']);

    //call the method
    $blog = Post::prioritize()->first();

    //test using assertion
    $this->assertEquals($important_post->id, $blog->id);
}


}
