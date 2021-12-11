<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->create('Евгений', 'Петросян', 'a@a.a', 1, 1);
        $this->create('Анастасия', 'Музыченко', 'a.skryganova@yandex.ru', 1, 2);
    }

    public function create(string $name, string $surname, string $email, int $role_id, int $cart_id)
    {
        User::factory()->create(compact('name', 'surname', 'email', 'role_id', 'cart_id'));
    }
}
