<?php

namespace App\Http\Livewire\Order;

use App\Models\{Delivery, Order, SettingsKey};
use App\Rules\Phone;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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

    public bool $needAddress = false;
    public string $index = '';
    public string $city = '';
    public string $address = '';

    protected function rules(): array
    {
        return [
            'name' => 'required|string',
            'surname' => 'required|string',
            'delivery_id' => 'required|exists:deliveries,id',
            'phone' => ['required', new Phone],
            'index' => [Rule::requiredIf($this->needAddress), 'integer', 'min:1'],
            'city' => [Rule::requiredIf($this->needAddress), 'string'],
            'address' => [Rule::requiredIf($this->needAddress), 'string'],
        ];
    }

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
        $cart = cartRepository()->getCart();

        \DB::beginTransaction();

        $order = Order::create($this->validate());
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
            $delivery = $this->deliveries[$this->delivery_id];
        } catch (\Exception $e){
            $this->addError('delivery', __('error'));
        }
        $this->emit('deliverySelected', $delivery);
        $this->needAddress = $delivery['need_address'];
    }

    public function render()
    {
        return view('livewire.order.create');
    }
}
