<div class="">

    <div class="py-2 flex space-x-2">

        <input wire:model="name" type="text" class="s" placeholder="{{ __('name') }}">
        <x-button wire:click.prevent="store" class="s success">{{ __('create') }}</x-button>

    </div>

    <div class="py-2 divide-y">

        <div class="flex">
            <div class="p-1 font-bold w-1/12">#</div>
            <div class="p-1 font-bold w-1/4">{{ __('title') }}</div>
            <div class="p-1 font-bold w-1/4">{{ __('slug') }}</div>
            <div class="p-1 font-bold w-1/3">{{ __('actions') }}</div>
        </div>

        <div>
        @forelse($categories as $category)
            <livewire:admin.categories.show :categoryModel="$category" :key="'category-'.$category->id" />
        @empty
        @endforelse
        </div>

    </div>

    @if($editId)
        <livewire:modal template="livewire.admin.categories.edit" :data="[$editId=>[$categories->$editId->name]]" :key="'admin.categories.edit'.$editId" />
    @endif

</div>
