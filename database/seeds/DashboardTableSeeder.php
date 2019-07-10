<?php

use Illuminate\Database\Seeder;

class DashboardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Module
        $module = DB::table('modules')->where('name', 'dashboard')->first();
        if(!$module){
            $module = DB::table('modules')->create([
                'name' => 'dashboard',
                'display_name' => 'Dashboard',
                'icon' => 'icon-speedometer'
            ]);
        }
    }
}
