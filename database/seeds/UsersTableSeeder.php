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
            'email' => 'lukeraus95@gmail.com',
            'password' => bcrypt('secret'),
            'facebook' => 'GigaSavvy',
            'twitter' => 'Gigasavvy',
            'instagram' => 'theguitarrevolution',
            'fb_api_key' => '1675423156013517',
            'fb_api_secret' => 'e336cc48fe592916c5968024714d7a89',
        ]);
    }
}
