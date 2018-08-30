<?php

use Illuminate\Database\Seeder;
// use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::table('users')->insert([
            [
                'role_id' => 1,
                'name'      => 'Parvez Alam',
                'username'  => 'parvez',
                'email'     => 'p4alam@gmail.com',
                'image'     => 'default.png',
                'about'     => '',
                'password'  => bcrypt('123456')
            ],
            [
                'role_id' => 2,
                'name'      => 'Agent',
                'username'  => 'agent',
                'email'     => 'agent@gmail.com',
                'image'     => 'default.png',
                'about'     => '',
                'password'  => bcrypt('123456')
            ],
            [
                'role_id' => 3,
                'name'      => 'User',
                'username'  => 'user',
                'email'     => 'user@gmail.com',
                'image'     => 'default.png',
                'about'     => null,
                'password'  => bcrypt('123456')
            ],
        ]);


        DB::table('roles')->insert([
            [
                'name' => 'Admin',
                'slug' => 'admin'
            ],
            [
                'name' => 'Agent',
                'slug' => 'agent'
            ],
            [
                'name' => 'User',
                'slug' => 'user'
            ]
        ]);


    }
}
