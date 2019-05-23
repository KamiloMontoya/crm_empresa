<?php

use Illuminate\Database\Seeder;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Module
        $moduleId = DB::table('modules')->insertGetId([
            'name' => 'services',
            'display_name' => 'Servicios',
            'icon' => 'icon-book'
        ]);


        // Permissions
        DB::table('permissions')->insert([
            [
                'name' => 'read-services',
                'display_name' => 'Read',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ],
            [
                'name' => 'create-services',
                'display_name' => 'Create',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ],
            [
                'name' => 'update-services',
                'display_name' => 'Update',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ],
            [
                'name' => 'delete-services',
                'display_name' => 'Delete',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ]
        ]);

    }
}
