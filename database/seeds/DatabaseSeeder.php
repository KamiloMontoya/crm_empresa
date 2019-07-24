<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(ProfileTableSeeder::class);
        $this->call(DashboardTableSeeder::class);
        $this->call(ServiceTableSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ContactTableSeeder::class);
        $this->call(ContactHasServicesTableSeeder::class);
        $this->call(InstallationOrderTableSeeder::class);
        $this->call(InstallationOrderStatusTableSeeder::class);
        $this->call(PromotionsTableSeeder::class);
        $this->call(ServiceStatusTableSeeder::class);
        $this->call(InvoicesTableSeeder::class);
    }

}
