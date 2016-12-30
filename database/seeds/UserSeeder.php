<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'device_token' => 'token',
            'email' => "admin@gmail.com",
            'password' => bcrypt("qweqwe")
        ]);

        // attaching admin role to user
        if ( $user )
            $user->attachRole(1);
    }
}
