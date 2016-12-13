<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
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

    public function testSignUp(){

        $response = $this->call('POST', '/login', [
            'email' => 'riyad.cse05@gmail.com',
            'password' => '123456123',
            'role'=>'Admin'
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }
}
