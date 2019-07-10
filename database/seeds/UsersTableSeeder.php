<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Module
        $module = DB::table('modules')->where('name', 'users')->first();
        if(!$module){
            $module = DB::table('modules')->insert([
                'name' => 'users',
                'display_name' => 'Users',
                'icon' => 'icon-people'
            ]);
        }
        $module = DB::table('modules')->where('name', 'users')->first();
        $moduleId = $module->id;

        // Permissions
        $permissions = [
            [
                'name' => 'read-users',
                'display_name' => 'Read',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ],
            [
                'name' => 'create-users',
                'display_name' => 'Create',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ],
            [
                'name' => 'update-users',
                'display_name' => 'Update',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ],
            [
                'name' => 'delete-users',
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

        // Create default user
        $user = \App\User::where('email', 'admin@sumernet.com')->first();

        if(!$user){
            $user = \App\User::create([
                'name' => 'admin',
                'email' => 'admin@sumernet.com',
                'password' => bcrypt('admin@sumernet.com'),
                'avatar' => 'avatar.png'
            ]);
            // Assign admin role to default user
            $user->assignRole('admin');

             // Generate avatar to defautl user NO correr en HEROKU
            $avatar = Avatar::create($user->name)->getImageObject()->encode('png');
            Storage::disk('public')::put('avatars/'.$user->id.'/avatar.png', (string) $avatar);
        }
       
    }
}
