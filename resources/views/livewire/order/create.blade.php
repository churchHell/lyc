<div class="space-y-8">

        @if(!$form)

            <x-button wire:click="$toggle('form')" class="s success">{{ __('arrange') }}</x-button>

        @else

            <form wire:submit.prevent="store" class="flex flex-col space-y-8">
                <div class="flex flex-col space-y-2">
                    <div class="">
                        <div>{{ __('name') }}:</div>
                        <x-input wire:model.lazy="name" class="s"></x-input>
                    </div>
                    <div class="">
                        <div>{{ __('surname') }}:</div>
                        <x-input wire:model.lazy="surname" class="s"></x-input>
                    </div>
                    <div class="">
                        <div>{{ __('phone') }}:</div>
                        <x-input wire:model.lazy="phone" class="s"></x-input>
                    </div>
                </div>

                <div class="space-y-1">
                    <div>{{ __('delivery') }}:</div>
                    @forelse ($deliveries as $delivery)
                        <div class="flex space-x-4 items-start">
                            <input wire:model="delivery_id" type="radio" value="{{ $delivery['id'] }}" class="">
                            <div class="">
                                <div>
                                    <span class="font-bold">{{ $delivery['name'] }}.</span>
                                    <span>{{ renderPrice($delivery['price']) }}</span>
                                </div>
                                <div class="italic">{{ $delivery['description'] }}</div>
                                @if((bool)$delivery['active_free_price'])
                                    <div class="">{{ __('free_delivery').' '.__('from') }}: {{ renderPrice($delivery['free_price']) }}</div>
                                @endif
                            </div>
                        </div>
                    @empty
                        {{ __('empty') }}
                    @endforelse
                    <x-error>delivery</x-error>
                    <x-error>delivery_id</x-error>
                </div>

                @if($needAddress)
                    <div class="space-y-2">
                        <div class="">
                            <div>{{ __('patronymic') }}:</div>
                            <x-input wire:model.lazy="patronymic" class="s"></x-input>
                        </div>
                        <div class="">
                            <div>{{ __('index') }}:</div>
                            <x-input wire:model.lazy="index" class="s"></x-input>
                        </div>
                        <div class="">
                            <div>{{ __('city') }}:</div>
                            <x-input wire:model.lazy="city" class="s"></x-input>
                        </div>
                        <div class="">
                            <div>{{ __('address') }}:</div>
                            <x-input wire:model.lazy="address" class="s"></x-input>
                        </div>
                    </div>
                @endif
                

                <div class="">
                    <x-button type="submit" class="s success">{{ __('arrange') }}</x-button>
                </div>

                @error('not-created')
                    <div class="m danger">
                        {{ $settings['not-created']['value'] }}
                    </div>
                @enderror

            </form>

        @endif

</div>
