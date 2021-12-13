<?php

namespace App\Http\Livewire\Order;

use App\Models\{Delivery, Order, SettingsKey};
use App\Rules\Phone;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Create extends Component
{

    use AuthorizesRequests;

    public bool $form = false;

    public string $name = '';
    public string $surname = '';
    public string $phone = '';

    public array $deliveries = [];
    public ?int $delivery_id = null;

    protected array $rules = [
        'name' => 'required|string',
        'surname' => 'required|string',
        'delivery_id' => 'required|exists:deliveries,id',
    ];

    public function mount()
    {
        if(auth()->check()){
            $this->name = auth()->user()->name;
            $this->surname = auth()->user()->surname;
            $this->phone = auth()->user()->phone;
        }
        $this->deliveries = Delivery::active()->get()->keyBy('id')->toArray();
    }

    public function store(): void
    {
        $validated = array_merge(
            $this->validate(),
            Validator::make(['phone' => $this->phone], ['phone' => ['required', new Phone]])->validate()
        );

        $cart = cartRepository()->getCart();

        \DB::beginTransaction();

        $order = Order::create($validated);
        $order->purchases()->attach($cart->purchases->pluck('id')->toArray());

        \DB::commit();

        if(!empty($order) && $order->exists){
            $this->emit('orderCreated');
            $this->emitTo('cart.icon', 'render');
        } else {
            $this->addError('not-created', $this->settings['not-created']['value']);
        }

    }

    public function updatedDeliveryId(): void
    {
        try {
            $this->emit('deliverySelected', $this->deliveries[$this->delivery_id]['price']);
        } catch (\Exception $e){
            $this->addError('delivery', __('error'));
        }
    }

    public function render()
    {
        return view('livewire.order.create');
    }
}
