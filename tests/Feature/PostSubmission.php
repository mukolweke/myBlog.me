<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostSubmission extends TestCase
{

    use DatabaseTransactions;

    /* testing
     *  to see if the data posted to our database
     * is one thats being sent there
     */
    public function testGameRetrieval()
    {
        $insertedpost = factory(Post::class)->create();

        // When I fetch the latest games
        $retrievedpost = Post::latest()->get();

        // Then I should have a correct response of 1 post
        // Inserted post should match first result of latest() method call (retrieved post)
        $this->assertEquals($insertedpost->toArray(), $retrievedpost[0]->toArray());
    }


}
