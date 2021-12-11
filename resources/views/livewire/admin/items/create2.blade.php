<div class="divide-y">

    <form wire:submit.prevent="update" class="pb-8 flex flex-col space-y-4">

        <div class="">
            <div>{{ __('name') }}:</div>
            <x-input wire:model.lazy="item.name" class="s w-full"></x-input>
            <div class="text-xs text-primary space-x-8">
                <span>#{{$item['id']}}</span>
                <span>{{ $item['slug'] }}</span>
            </div>
        </div>

        <div class="">
            <div>{{ __('description') }}:</div>
            <x-trix wire:model="item.description"></x-trix>
        </div>

        <div class="">
            <div>{{ __('qty') }}:</div>
            <x-input wire:model.lazy="item.qty" class="s"></x-input>
        </div>

        <div class="">
            <div>{{ __('price') }}:</div>
            <x-input wire:model.lazy="item.price" class="s"></x-input>
        </div>

        <div>
            <x-checkbox prop="item.active" cond="{{$item['active']}}"></x-checkbox>
        </div>

        <div>
            <x-button type="submit" id="submit" class="s success">{{ __('update') }}</x-button>
        </div>

    </form>

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
                        <x-button wire:click="deleteProperty({{$property['id']}})" class="xs danger">{{ __('delete') }}</x-button>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="flex space-x-2">
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


    @if(false)



        <div class="flex flex-col">
            <div class="flex space-x-2">
                <span>{{ __('categories') }}:</span>
                <div x-data="{categories: false}" class="">
                    <x-button @click="categories = true" class="s warning">
                        {{ $categoryId ? $allCategories->get($categoryId)->name : __('select') }}
                    </x-button>
                    <div x-show="categories" class="" style="display: none;">
                        @foreach ($allCategories->except($categories) as $category)
                            <x-button @click="categories = false" wire:click="$set('categoryId', {{ $category->id }})"
                                      class="s danger">
                                {{ $category->name }}
                            </x-button>
                        @endforeach
                    </div>
                </div>
                @if($categoryId)
                    <x-button wire:click="addCategory" class="xs success">+</x-button> @endif
            </div>
            <div class="flex flex-col">
                @foreach($categories as $key => $category)
                    <div class="flex space-x-2">
                <span>
                    {{ $allCategories->get($category)->name }}
                </span>
                        <x-button wire:click="deleteCategory({{$key}})" class="xs danger">-</x-button>
                    </div>
                @endforeach
            </div>

        </div>

        <hr>



        <hr>

        <div class="flex flex-col">
            <div class="flex space-x-2">
                <span>{{ __('properties') }}:</span>
                <div x-data="{properties: false}" class="">
                    <x-button @click="properties = true" class="s warning">
                        {{ $propertyId ? $allProperties->get($propertyId)->name.'('.$allProperties->get($propertyId)->unit->name.')' : __('select') }}
                    </x-button>
                    <div x-show="properties" class="" style="display: none;">
                        @foreach ($allProperties as $property)
                            <x-button @click="properties = false" wire:click="$set('propertyId', {{ $property->id }})"
                                      class="s danger">
                                {{ $property->name }}({{ $property->unit->name }})
                            </x-button>
                        @endforeach
                    </div>
                </div>
                @if($propertyId)
                    <x-input wire:model.lazy="propertyValue"></x-input>
                    <x-button wire:click="addProperty" class="xs success">+</x-button>
                @endif
            </div>
            @foreach($properties as $key => $property)
                <div class="flex flex-col">
                    <div class="flex">
                        <div class="flex space-x-2">
                    <span>
                        {{ $allProperties->get($property['id'])->name }}
                        ({{ $allProperties->get($property['id'])->unit->name }})
                    </span>
                            <span>
                        {{ $property['value'] }}
                    </span>
                            <x-button wire:click="deleteProperty({{$key}})" class="xs danger">-</x-button>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <hr>





        <hr>

        <x-textarea-scripts></x-textarea-scripts>
    @endif


</div>
