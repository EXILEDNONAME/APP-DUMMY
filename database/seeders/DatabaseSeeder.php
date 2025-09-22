<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(Setting\SettingSeeder::class);
        $this->call(Setting\OptimizationSeeder::class);
        $this->call(Setting\CustomizationSeeder::class);
        $this->call(Default\StatusFilterSeeder::class);

        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(Application\Datatable\GeneralSeeder::class);
    }
}
