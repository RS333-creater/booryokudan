<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'email' => 'test1@example.com',
                'password' => bcrypt('password1'),
                'passport' => '123456789',
                'birth_day' => '1990-01-01',
            ],
            [
                'email' => 'test2@example.com',
                'password' => bcrypt('password2'),
                'passport' => '987654321',
                'birth_day' => '1985-05-15',
            ],
            [
                'email' => 'test3@example.com',
                'password' => bcrypt('password3'),
                'passport' => '987654312',
                'birth_day' => '1985-05-14',
            ],
        ]);
    }
}
