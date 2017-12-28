<?php

use Illuminate\Database\Seeder;

class CreateUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@domain.com',
            'password' => bcrypt('secret'),
        ]);
    }
}