<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create('Новый', 'yellow');
        $this->create('Завершен', 'green');
    }

    public function create(string $name, string $color): void
    {
    	Status::factory()->create([
    		'name' => $name,
    		'color' => $color
    	]);
    }

}
