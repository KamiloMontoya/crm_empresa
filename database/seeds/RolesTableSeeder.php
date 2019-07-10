<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Module
        $module = DB::table('modules')->where('name', 'roles')->first();
        if(!$module){
            $module = DB::table('modules')->insert([
                'name' => 'roles',
                'display_name' => 'Roles',
                'icon' => 'icon-key'
            ]);
        }
        $module = DB::table('modules')->where('name', 'roles')->first();
        $moduleId = $module->id;

        // Permissions
        $permissions = [
            [
                'name' => 'read-roles',
                'display_name' => 'Read',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ],
            [
                'name' => 'create-roles',
                'display_name' => 'Create',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ],
            [
                'name' => 'update-roles',
                'display_name' => 'Update',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ],
            [
                'name' => 'delete-roles',
                'display_name' => 'Delete',
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

        // Create default roles
        $admin = Role::findByName('admin');
        if (! $admin ){
            $admin = Role::create([
                'name' => 'admin',
                'display_name' => 'Admin'
            ]);
        }
        
        $user = Role::findByName('user');
        if (! $user ){
            $user = Role::create([
                'name' => 'user',
                'display_name' => 'User'
            ]);
        }

        // Assign permissions to admin role
        $admin->givePermissionTo(Permission::all());
    }
}
