<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $owner = new Role();
        $owner->name = 'admin';
        $owner->display_name = 'Администратор';
        $owner->description = 'User with admin permissions, can edit everything';
        $owner->save();
    }
}
