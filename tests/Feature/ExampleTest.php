<?php

namespace Tests\Feature;

use App\Post;
use App\Repository\Posts\PostsRepository;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Faker\Generator as Faker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{

    use DatabaseTransactions;
    use WithFaker;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }


    public function loginUser()
    {
        $user = factory(User::class)->create();

        Auth::login($user, true);

        return Auth::user();
    }


    public function testBlogRetrieval()
    {
        $insertedpost = factory(Post::class)->create();

        // When I fetch the latest games
        $retrievedpost = Post::latest()->get();

        // Then I should have a correct response of 1 post
        // Inserted post should match first result of latest() method call (retrieved post)
        $this->assertEquals($insertedpost->toArray(), $retrievedpost[0]->toArray());
    }

    public function test_user_log_in_create_post()
    {
        // user log in
        $user = factory(User::class)->create();

        // fake blog data created
        $blog = factory(Post::class, 2)->create();

        $data = [
            'title' => $this->faker->word,
            'body' => $this->faker->text,
            'user_id' => $user->id,
        ];

        // enter data
        $postRepo = new PostsRepository();

        $postedBlog = $postRepo->postTestBlog($data);

        // assert the user that posted the blod it one logged in
        $this->assertEquals($postedBlog->user_id, $user->id);
    }
}
