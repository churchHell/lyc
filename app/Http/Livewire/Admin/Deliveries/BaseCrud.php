<?php

namespace App\Http\Livewire\Admin\Deliveries;

use App\Http\Livewire\Traits\Crud;
use App\Models\Delivery;
use App\Rules\Price;
use Livewire\Component;

class BaseCrud extends Component
{

    use Crud;

    protected string $class = Delivery::class;

    public ?string $description = '';
    public string $name = '';
    public ?string $price = '';
    public bool $active_free_price = false;
    public ?string $free_price = '';

    protected function rules()
    {
        return [
            'description' => 'string',
            'name' => 'required|string',
            'price' => ['required', new Price()],
            'active_free_price' => 'required|boolean',
            'free_price' => [new Price()]
        ];
    }

    public function render()
    {
        return view('livewire.admin.deliveries.base-crud');
    }
}
