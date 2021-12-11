<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::factory()->create(['settings_key_id' => 1, 'slug' => 'phone1', 'name' => 'Телефон', 'data_type_id' => 2, 'value' => '98769876']);
        Setting::factory()->create(['settings_key_id' => 1, 'slug' => 'phone2', 'name' => 'Телефон', 'data_type_id' => 2, 'value' => '222098554']);
        Setting::factory()->create(['settings_key_id' => 1, 'slug' => 'address1', 'name' => 'Адрес', 'data_type_id' => 2, 'value' => 'ул. Магазинная, д. 1']);
        Setting::factory()->create(['settings_key_id' => 3, 'slug' => 'about', 'name' => 'О нас', 'data_type_id' => 4, 'value' => '<div><strong>О нас:</strong></div><ul><li>мы самый лучший магазин</li></ul>']);
        Setting::factory()->create(['settings_key_id' => 4, 'slug' => 'created', 'name' => 'Заказ оформлен', 'data_type_id' => 4, 'value' => 'Заказ оформлен успешно. Через некоторое время с вами свяжется администратор']);
        Setting::factory()->create(['settings_key_id' => 4, 'slug' => 'not-created', 'name' => 'Заказ не оформлен', 'data_type_id' => 4, 'value' => 'Произошла ошибка во время создания заказа. Пожалуйста попробуте позже или свяжитесь с адинистрацией.']);
    }
}
