<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('ruman5224'),
            'role_id' => '1'
        ]);

        DB::table('users')->insert([
            'name' => 'Author',
            'email' => 'author@gmail.com',
            'password' => bcrypt('ruman5224'),
            'role_id' => '2'
        ]);

    }
}
