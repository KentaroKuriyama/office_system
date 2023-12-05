<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'id'   => 1,
                'name' => 'システム管理者',
            ],
            [
                'id'   => 2,
                'name' => '一般管理者',
            ],
            [
                'id'   => 99,
                'name' => '一般ユーザ',
            ]
        ]);
    }
}
