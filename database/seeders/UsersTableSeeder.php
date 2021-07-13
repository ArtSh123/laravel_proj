<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Unknown Name',
                'email' => 'unknown_name@gmail.com',
                'password' => bcrypt(Str::random(16)),
            ],
            [
                'name' => 'Name',
                'email' => 'name@gmail.com',
                'password' => bcrypt('123123'),
            ]
        ];

        \DB::table('users')->insert($users);
    }
}
