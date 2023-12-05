<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => '佐藤太郎',
                'email'     => Str::random(10).'@abc.com',
                'password'  => Hash::make('asdfghjk'),
                'login_id'  => 'hoge',
                'role_id'   => 1
            ],
            [
                'name' => '遠藤次郎',
                'email'     => Str::random(10).'@abc.com',
                'password'  => Hash::make('asdfghjk'),
                'login_id'  => 'age',
                'role_id'   => 2
            ],
        ]);
    }
}
