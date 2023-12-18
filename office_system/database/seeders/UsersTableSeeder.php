<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'システム管理者',
            'login_id' => 'admin',
            'role_id' => 1,
            'email' => Str::random(10).'@abc.com',
            'password' => Hash::make('asdfghjk'),
            'created_at' => now(),
        ]);

        User::factory()->count(30)->create();
    }
}
