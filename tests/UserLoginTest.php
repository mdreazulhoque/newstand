<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserLoginTest extends TestCase
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

    public function testUserSignUp(){

        $response = $this->call('POST', '/login', [
            'email' => 'riyad.cse05@gmail.com',
            'password' => 'newsstand2016',
            'role'=>'User'
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }
}
