<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ServiceStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Module
        $module = DB::table('modules')->where('name', 'service_status')->first();
        if(!$module){
            $module = DB::table('modules')->insert([
                'name' => 'service_status',
                'display_name' => 'Estados Servicios',
                'icon' => 'fa fa-briefcase'
            ]);
        }
        $module = DB::table('modules')->where('name', 'service_status')->first();
        $moduleId = $module->id;


        // Permissions
        $permissions = [
            [
                'name' => 'read-service_status',
                'display_name' => 'Read',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ],
            [
                'name' => 'create-service_status',
                'display_name' => 'Create',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ],
            [
                'name' => 'update-service_status',
                'display_name' => 'Update',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ],
            [
                'name' => 'delete-service_status',
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


        // Add Default registers to table
        $registers = [
        	[ 
        		'name' => 'activo',
        		'long_name' => 'Activo',
        		'is_default' => 1
        	],
        	[ 
        		'name' => 'suspendido',
        		'long_name' => 'Suspendido',
        		'is_default' => 0
        	],
        	[ 
        		'name' => 'cancelado',
        		'long_name' => 'Cancelado',
        		'is_default' => 0
        	]
        ];

        foreach ($registers as $register){
        	$prev = \App\Models\Services\ServiceStatus::where('name', $register['name'])->first();
        	if (!$prev){
        		\App\Models\Services\ServiceStatus::create($register);
        	}
        }
    }
}
