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
            'name' => 'gigasavvy',
            'email' => 'luke@gmail.com',
            'password' => bcrypt('secret'),
            'facebook' => 'GigaSavvy',
            'twitter' => 'Gigasavvy',
            'instagram' => 'theguitarrevolution',
        ]);
    }
}
