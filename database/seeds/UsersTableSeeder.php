<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            array(
                array(
                    'first_name' => 'reazul',
                    'last_name' => 'haque',
                    'phone' => '01713523712',
                    'email' => 'riyad.cse05@gmail.com',
                    'dob' => '1998-03-01',
                    'address' => 'Dhaka,bangladesh',
                    'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
                ),
                array(
                'first_name' => 'riyad',
                'last_name' => 'sikder',
                'phone' => '01716160035',
                'email' => 'riyad.csesust@gmail.com',
                'dob' => '1998-03-01',
                'address' => 'Dhaka,bangladesh',
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
            )
            ));
    }
}
