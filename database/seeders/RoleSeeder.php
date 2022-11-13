<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'User Administrator',
            'description' => 'This is User Administrator role',
            'created_at' => Carbon::now(),
        ]);
        DB::table('roles')->insert([
            'name' => 'Moderator',
            'description' => 'This is Moderator role',
            'created_at' => Carbon::now(),
        ]);
        DB::table('roles')->insert([
            'name' => 'Theme Manager',
            'description' => 'This is Theme Manager role',
            'created_at' => Carbon::now(),
        ]);
    }
}
