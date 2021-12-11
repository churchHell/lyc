<?php

namespace Database\Seeders;

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
        $this->call([
            UnitSeeder::class,
            RoleSeeder::class,
            DataTypeSeeder::class,
            PropertySeeder::class,
            CartSeeder::class,
            UserSeeder::class,
//            CategorySeeder::class,
            SettingsKeySeeder::class,
            SettingSeeder::class,
            DeliverySeeder::class,
//            ItemSeeder::class,
            StatusSeeder::class,
        ]);
    }
}
