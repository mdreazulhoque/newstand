<?php

use Illuminate\Database\Seeder;

class UsersLoginTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_id_admin = DB::table('users')
            ->select('id')
            ->where('email', 'riyad.cse05@gmail.com')
            ->first()
            ->id;
        $user_id_user = DB::table('users')
            ->select('id')
            ->where('email', 'admin@newsstand.com')
            ->first()
            ->id;

        DB::table('login_users')->insert(
            array(
                array(
                    'role' => 'User',
                    'user_id' => $user_id_admin,
                    'email' => 'riyad.cse05@gmail.com',
                    'password' => bcrypt('newsstand2016'),
                    'status' => 'Active',
                    'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
                ),
                array(
                'role' => 'Admin',
                'user_id' => $user_id_user,
                'email' => 'admin@newsstand.com',
                'password' => bcrypt('newsstand2016'),
                'status' => 'Active',
                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s')
            )
            ));

    }
}
