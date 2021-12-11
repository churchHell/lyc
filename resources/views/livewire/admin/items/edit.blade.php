<div class="divide-y">

    <form wire:submit.prevent="{{ !empty($item['id']) ? 'update' : 'store' }}" class="pb-8 flex flex-col space-y-4">

        <div class="">
            <div>{{ __('name') }}:</div>
            <x-input wire:model.debounce.99999s="item.name" class="s w-full"></x-input>
            @if(!empty($item['id']))
                <div class="text-xs text-primary space-x-8">
                    <span>#{{$item['id']}}</span>
                    <span>{{ $item['slug'] }}</span>
                </div>
            @endif
        </div>

        <div class="">
            <div>{{ __('description') }}:</div>
            <x-trix wire:model="item.description"></x-trix>
        </div>

        <div class="">
            <div>{{ __('qty') }}:</div>
            <x-input wire:model.debounce.99999s="item.qty" class="s"></x-input>
        </div>

        <div class="">
            <div>{{ __('price') }}:</div>
            <x-input wire:model.debounce.99999s="item.price" class="s"></x-input>
        </div>

        <div>
            <x-checkbox prop="item.active" cond="{{ $item['active'] ?? true }}"></x-checkbox>
        </div>

        <div>
            <x-button type="submit" id="submit" class="s success">{{ __(!empty($item['id']) ? 'update' : 'create') }}</x-button>
        </div>

    </form>

    @if(!empty($item['id']))

        <div class="py-8 flex flex-col space-y-2">
            @if (count($item['images']) > 0)
                <div class="flex space-x-8 flex-wrap">
                    @foreach ($item['images'] as $image)
                        <div class="flex space-x-1">
                            <img class="w-20 h-20" src="{{ Storage::url($image['path']) }}">
                            <x-button wire:click="deleteImage({{ $image['id'] }})"
                                      class="xs danger">{{ __('delete') }}</x-button>
                        </div>
                    @endforeach
                </div>
            @endif

            <livewire:admin.images-upload path="/items/{{$item['id']}}"/>

        </div>

        <div class="py-8 flex flex-col space-y-2">
            <div>{{ __('categories') }}:</div>
            <div class="flex flex-col space-y-1">
                @foreach($item['categories'] as $category)
                    <div class="flex items-center space-x-4">
                        <div>{{ $category['name'] }}</div>
                        <x-button wire:click="deleteCategory({{$category['id']}})"
                                  class="xs danger">{{ __('delete') }}</x-button>
                    </div>
                @endforeach
            </div>
            <x-select>
                @foreach($filteredCategories as $category)
                    <div
                            wire:click="addCategory({{$category['id']}})"
                            class="s hover:bg-primary hover:text-white cursor-pointer"
                    >
                        {{$category['name']}}
                    </div>
                @endforeach
            </x-select>
        </div>

        <div class="flex flex-col space-y-2">
            <div>{{ __('properties') }}:</div>
            <div class="space-y-1">
                @foreach($item['properties'] as $key => $property)
                    <div class="flex space-x-8">
                        <div>
                            {{ $property['name'] }}:
                            {{ $property['pivot']['value']}}
                            ({{ $property['unit']['name']}})
                        </div>
                        <div class="">
                            <x-button wire:click="deleteProperty({{$property['id']}})"
                                      class="xs danger">{{ __('delete') }}</x-button>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex space-x-2">
                <x-input wire:model.delay.9999s="propertyValue" placeholder="{{ __('value') }}" class="s"></x-input>
                <x-select>
                    @foreach ($properties as $property)
                        <div
                                wire:click="addProperty({{$property['id']}})"
                                class="s hover:bg-primary hover:text-white cursor-pointer"
                        >
                            {{$property['name']}}
                        </div>
                    @endforeach
                </x-select>
            </div>


        </div>

    @endif

</div>
