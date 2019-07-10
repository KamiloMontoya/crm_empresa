<?php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class InstallationOrderStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Module
        $module = DB::table('modules')->where('name', 'installation_order_status')->first();
        if(!$module){
            $module = DB::table('modules')->insert([
                'name' => 'installation_order_status',
                'display_name' => 'Estados Instalación',
                'icon' => 'fa fa-briefcase'
            ]);
        }
        $module = DB::table('modules')->where('name', 'installation_order_status')->first();
        $moduleId = $module->id;


        // Permissions
        $permissions = [
            [
                'name' => 'read-installation_order_status',
                'display_name' => 'Read',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ],
            [
                'name' => 'create-installation_order_status',
                'display_name' => 'Create',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ],
            [
                'name' => 'update-installation_order_status',
                'display_name' => 'Update',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ],
            [
                'name' => 'delete-installation_order_status',
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
        		'name' => 'disponible',
        		'long_name' => 'Disponible',
        		'is_default' => 1
        	],
        	[ 
        		'name' => 'programado',
        		'long_name' => 'Programado',
        		'is_default' => 0
        	],
        	[ 
        		'name' => 'finalizado',
        		'long_name' => 'Finalizado',
        		'is_default' => 0
        	],
        	[ 
        		'name' => 'quiebre',
        		'long_name' => 'Quiebre',
        		'is_default' => 0
        	]
        ];

        foreach ($registers as $register){
        	$prev = \App\Models\InstallationOrders\InstallationOrderStatus::where('name', $register['name'])->first();
        	if (!$prev){
        		\App\Models\InstallationOrders\InstallationOrderStatus::create($register);
        	}
        }
    }
}
