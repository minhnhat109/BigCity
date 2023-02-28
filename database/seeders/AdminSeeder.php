<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();

        DB::table('admins')->truncate();

        DB::table('admins')->insert([
            [
            'first_name' => 'Minh',
            'last_name' => 'Nhat',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123123123'),
            'is_open'=>'1',
            ],
        ]);
    }
}
