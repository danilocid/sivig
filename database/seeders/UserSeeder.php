<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'danilo cid',
            'user' => 'danilo',
            'email' => 'danilo.cid.v@gmail.com',
            'password' => Hash::make('94679847'),
            'active' => '1',
        ]);
    }
}
