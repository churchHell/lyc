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

                <div class="">
                    {{ __('delivery') }}:
                    @forelse ($deliveries as $delivery)
                        <div class="flex space-x-4">
                            <input wire:model="delivery_id" type="radio" value="{{ $delivery['id'] }}" class="">
                            <div class="">
                                {{ $delivery['name'] }}
                                {{ $delivery['description'] }}
                            </div>
                        </div>
                    @empty

                    @endforelse
                </div>

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
