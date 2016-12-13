<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SignUpTest extends TestCase
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

        $response = $this->call('POST', '/user/register', [
            'first_name' => 'reazul',
            'last_name' => 'haque',
            'phone' => '01713523712',
            'email' => 'riyad.cse05@gmail.com',
            'dob' => '1998-03-01',
            'address' => 'Dhaka,bangladesh',
            'created_at' =>\Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }
}
