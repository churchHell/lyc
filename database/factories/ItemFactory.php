<?php

namespace Database\Factories;

use App\Models\{Category, Image, Item, Property};
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(rand(3, 8), true),
            'description' => $this->faker->sentences(rand(3, 8), true),
            'qty' => rand(1, 30),
            'price' => rand(5, 30), 
            'active' => (rand(1, 10) != 1)
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Item $item) {
            
        })->afterCreating(function (Item $item) {
            $categories = range(1, Category::count());
            shuffle($categories);
            $item->categories()->attach(array_slice($categories, rand(1, 3)));

            $properties = array_flip(range(1, Property::count()));
            data_set($properties, '*.value', rand(100, 1000));
            $item->properties()->attach($properties);

            $images = collect(range(0, rand(0, 6)));
            $images = $images->map(fn($image) => $image = Image::create(['path' => 'items/1/'.rand(1, 8).'.jpg']));
            $item->images()->attach($images->pluck('id'));
        });
    }
}
