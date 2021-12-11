<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataType;

class DataTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DataType::factory()->create(['slug' => 'checkbox']);
        DataType::factory()->create(['slug' => 'text']);
        DataType::factory()->create(['slug' => 'integer']);
        DataType::factory()->create(['slug' => 'textarea']);
    }
}
