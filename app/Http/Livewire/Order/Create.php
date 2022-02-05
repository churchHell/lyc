<?php

namespace App\Http\Livewire\Order;

use App\Models\{Cart, Delivery, Order, Promocode, SettingsKey};
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
    
    public string $promocode = '';

    public array $deliveries = [];
    public ?int $delivery_id = null;

    public bool $needAddress = false;
    public string $index = '';
    public string $patronymic = '';
    public string $city = '';
    public string $address = '';

    public array $settings = [];
    public Cart $cart;

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
        $this->cart = cartRepository()->getCart();
    }

    public function promocode():void
    {
        $validated = $this->validate(
            ['promocode' => 'required|string|exists:promocodes,code'],
            ['promocode.exists' => 'Данный :attribute не существует']
        );
        $promocode = $this->getPromocode($validated['promocode']);
        if(!$promocode){
            $this->addError('promocode', 'Промокод не активен');
            $this->reset('promocode');
            return;
        }
        if($promocode->min_price && $this->cart->price < $promocode->min_price){
            $this->addError('promocode', 'Сумма заказа меньше минимальной');
            $this->reset('promocode');
            $this->emit('resetPromocode');
            return;
        }
        $this->emit('acceptPromocode', $promocode);
        session()->flash('promocode', 'Применен промокод: ' . $promocode->code . ' ' . $promocode->description);
    }

    public function store()
    {
        $cart = cartRepository()->getCart();
        $promocode = $this->getPromocode($this->promocode);
        if($this->promocode){
            $cart->purchases = promocodeService()->acceptPromocode($cart->purchases, $promocode);
        }

        \DB::beginTransaction();

        if($this->promocode){
            foreach($cart->purchases as $purchase){
                unset($purchase->total_without_discount);
                $purchase->save();
            }
        }

        $order = Order::create($this->validate());
        $order->purchases()->attach($cart->purchases->pluck('id')->toArray());
        $order->promocodes()->attach($promocode->id);

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

    private function getPromocode(string $promocode): ?Promocode
    {
        $promocode = Promocode::whereCode($promocode)
            ->whereDate('starts_at', '<=', date("Y-m-d"))
            ->orWhereNull('starts_at')
            ->whereDate('ends_at', '>=', date("Y-m-d"))
            ->orWhereNull('ends_at')
            ->whereActive(true)
            ->first();
        return $promocode;
    }
}
