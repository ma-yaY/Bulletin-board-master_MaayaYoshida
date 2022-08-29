<?php

use Illuminate\Database\Seeder;

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
            'username' => 'kanri',
            'email' => 'kanri@gmail.com',
            'admin_role' => 1,
            'password' => bcrypt('password'),
             ]);
    }
}
