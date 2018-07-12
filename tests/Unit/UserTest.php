<?php

namespace Tests\Unit;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class UserTest extends TestCase
{


    // get username and password
    public function testIfWeCanInsertUserDetailsCorrectly()
    {
        $user = new User;

        $user->setUserFullName('Kuku Mike');
        $user->setUserEmailAddress('kmike@cytonn.com');

        $emaildetails = $user->getUserArrayVariables();

        $this->assertArrayHasKey('full_name', $emaildetails);
        $this->assertArrayHasKey('email', $emaildetails);

        $this->assertEquals($emaildetails['full_name'], 'Kuku Mike');
        $this->assertEquals($emaildetails['email'],'kmike@cytonn.com');

    }


//    // test successfull login
//    public function test_I_can_login_successfully()
//    {
//
//        $user = factory(User::class)->create([
//            'email' => 'mikekuku@gmail.com',
//        ]);
//
//
//        $this->browse(function ($browser) use ($user)  {
//            $browser->visit('/login')
//                ->type('email', $user->email)
//                ->type('password', 'secret')
//                ->press('Login')
//                ->assertSee('You are logged in!');
//        });

//        $user = factory(User::class,1)->create();
//
//        dd($user->email);
//
//        $postRequest = [
//            '_token' => csrf_token(),
//            'email' => $user->email,
//            'password' => $user->password,
//        ];
//
//        $this->post(route('login'), $postRequest)
////            ->assertSee('You are logged in');
//            ->assertRedirect('/dashboard');
//    }

}
