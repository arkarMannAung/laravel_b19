<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles = ['custormer','admin'];
        foreach ($roles as $role) {
        	$newRole = new Role;
        	$newRole->name=$role;
        	$newRole->save();        	
        }
    }
}
