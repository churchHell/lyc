<div class="space-y-4">

    <div class="">
        {{ __('name') }}
        <x-input wire:model.lazy="name" class="s"></x-input>
    </div>

    <hr>

    <div class="flex flex-col">
        <div class="flex space-x-2">
            <span>{{ __('categories') }}:</span>
            <div x-data="{categories: false}" class="">
                <x-button @click="categories = true" class="s warning">
                    {{ $categoryId ? $allCategories->get($categoryId)->name : __('select') }}
                </x-button>
                <div x-show="categories" class="" style="display: none;">
                    @foreach ($allCategories->except($categories) as $category)
                    <x-button @click="categories = false" wire:click="$set('categoryId', {{ $category->id }})" class="s danger">
                        {{ $category->name }}
                    </x-button>
                    @endforeach
                </div>
            </div>
            @if($categoryId) <x-button wire:click="addCategory" class="xs success">+</x-button> @endif
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

    <div class="">
        <input type="file" wire:model="photos" multiple>
        @error('photos.*') <span class="error">{{ $message }}</span> @enderror

        @if (count($photos) > 0)
        <div class="flex flex-col">
            @foreach ($photos as $key => $photo)
            <div class="flex space-x-4">
                <img class="w-20 h-20" src="{{ $photo->temporaryUrl() }}">
                <x-button wire:click="deleteImage({{ $key }})" class="xs danger">-</x-button>
            </div>
            @endforeach
        </div>
        @endif
    </div>

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
                    <x-button @click="properties = false" wire:click="$set('propertyId', {{ $property->id }})" class="s danger">
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

    <x-textarea></x-textarea>

    <hr>

    <x-input wire:model.lazy="qty" class=""></x-input>

    <hr>

    <x-input wire:model.lazy="price" class=""></x-input>

    <hr>

    <x-button wire:click="$toggle('active')" class="s {{ $active ? 'success' : 'danger' }}">{{ __('active') }}</x-button>

    <hr>

    <x-button wire:click="store" id="submit" class="s success">{{ __('create') }}</x-button>

    <x-textarea-scripts></x-textarea-scripts>

</div>
