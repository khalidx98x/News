<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //
        //create permission 'all' which can access all the application
        Permission::create([
            'name' => 'all',
        ]);

        $role = Role::create(['name' => 'super admin']);

        //gives 'all' permssion to 'super admin' role
        $role->givePermissionTo('all');

        //inital admin information
        $data = [
            'name' => 'admin',
            'email' => 'adminhohoih@admin.com',
            'password' => Hash::make('admin'),
            'type' => 1,
        ];

        $admin = User::create($data);

        //assign 'super admin' role to admin
        $admin->assignRole('super admin');
    }
}
