<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Module
        $module = DB::table('modules')->where('name', 'contacts')->first();
        if(!$module){
            $module = DB::table('modules')->insert([
                'name' => 'contacts',
                'display_name' => 'Contactos',
                'icon' => 'fa fa-users'
            ]);
        }
        $module = DB::table('modules')->where('name', 'contacts')->first();
        $moduleId = $module->id;


        // Permissions
        $permissions = [
            [
                'name' => 'read-contacts',
                'display_name' => 'Read',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ],
            [
                'name' => 'create-contacts',
                'display_name' => 'Create',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ],
            [
                'name' => 'update-contacts',
                'display_name' => 'Update',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ],
            [
                'name' => 'delete-contacts',
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

        // Assign permissions to admin role
        $admin = Role::findByName('admin');
        $admin->givePermissionTo(Permission::all());
    }
}
