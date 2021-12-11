<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SettingsKey;

class SettingsKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SettingsKey::factory()->create(['slug' => 'contact']);
        SettingsKey::factory()->create(['slug' => 'item']);
        SettingsKey::factory()->create(['slug' => 'content']);
        SettingsKey::factory()->create(['slug' => 'order']);
    }
}
