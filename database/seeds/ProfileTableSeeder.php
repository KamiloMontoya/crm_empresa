<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Module
        $module = DB::table('modules')->where('name', 'profile')->first();
        if(!$module){
            $module = DB::table('modules')->insert([
                'name' => 'profile',
                'display_name' => 'Profile',
                'icon' => 'icon-user',
                'active' => false
            ]);
        }
        $module = DB::table('modules')->where('name', 'profile')->first();
        $moduleId = $module->id;


        // Permissions
        $permissions = [
            [
                'name' => 'read-profile',
                'display_name' => 'Read Profile',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ],
            [
                'name' => 'update-profile',
                'display_name' => 'Update Profile',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ],
            [
                'name' => 'read-profile-password',
                'display_name' => 'Read Password',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ],
            [
                'name' => 'update-profile-password',
                'display_name' => 'Update Password',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ]
        ];

        foreach ($permissions as $permission_data) {
            $_permision = DB::table('permissions')->where('name',  $permission_data['name'])->first();
            if (!$_permision ){
                Permission::create($permission_data);
            }
        }

        // Assign permissions to admin role
        $admin = Role::findByName('admin');
        $admin->givePermissionTo(Permission::all());

        // Assign permissions to user role
        $user = Role::findByName('user');
        $user->givePermissionTo('read-profile', 'update-profile', 'read-profile-password', 'update-profile-password');

    }
}
