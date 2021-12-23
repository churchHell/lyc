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
    public string $patronymic = '';
    public string $city = '';
    public string $address = '';

    public array $settings = [];

    // protected $listeners = ['cartUpdated'];

    protected function rules(): array
    {
        return [
            'name' => 'required|string',
            'surname' => 'required|string',
            'delivery_id' => 'required|exists:deliveries,id',
            'phone' => ['required', new Phone],
            'patronymic' => [Rule::requiredIf($this->needAddress), 'string'],
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
        $this->settings = SettingsKey::whereSlug('order')->first()->settings->keyBy('slug')->toArray();
    }

    public function store()
    {
        $cart = cartRepository()->getCart();

        \DB::beginTransaction();

        $order = Order::create($this->validate());
        $order->purchases()->attach($cart->purchases->pluck('id')->toArray());

        if(!empty($order) && $order->exists){
            $response = alphaService()->gateway(
                config('alpha.registerDo'),
                alphaService()->getRegisterData($order)
            );  

            if(!empty($response['formUrl'])){

                \DB::commit();

                return redirect()->to($response['formUrl']);
            } 
        }
        $this->addError('error', 
            !empty($this->settings['not-created']['value'])
                ? $this->settings['not-created']['value']
                : __('error')
        );

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
