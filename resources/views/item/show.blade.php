@extends('layouts.main')

@section('content')

    <div class="divide-y">

        <div class="flex flex-col sm:flex-row items-center sm:items-start sm:space-x-8 space-y-4 sm:space-y-0 pb-8">

            <div x-data="{path: '{{Storage::url($item->image->path)}}'}" class="flex flex-col w-1/3 space-y-2">
                <img class="h-96 w-96 object-contain" x-bind:src="path" alt="{{ $item->name }}"
                     title="{{ $item->name }}">
                <div class="flex space-x-2">
                    @forelse($item->images as $image)
                        <x-img @click="path = '{{Storage::url($image->path)}}'" class='h-20' path="{{ $image->path }}"
                               name="{{ $item->name }}"></x-img>
                    @empty
                    @endforelse
                </div>
            </div>

            <div class="w-1/2 space-y-4 sm:space-y-8">

                <div class="flex flex-col sm:flex-row space-y-2 justify-between">
                    <div>{{ $item->name }}</div>
                    <livewire:cart.create :item="$item" :key="'cart-create-'.$item->id"/>
                </div>

                <div class="">
                    {{ __('price') }}: {{ renderPrice($item->price) }}
                </div>

                @if($item->properties->count())
                    <ul class="">
                        @foreach($item->properties as $property)
                            <li class="">
                                {{ $property->name }}: {{ $property->pivot->value }} {{ $property->unit->name }}.
                            </li>
                        @endforeach
                    </ul>
                @endif

                <div class="">
                    {!! $item->description !!}
                </div>

            </div>

        </div>

        @if (!empty($additionalItems) && $additionalItems->count() > 0)
            <div class="space-y-2 pt-8 items-center sm:items-start">
                <div class="font-bold font-xl">{{ __('also-like') }}</div>
                <div class="flex flex-wrap justify-center items-center space-y-4 space-x-4 max-w-7xl">
                    @foreach($additionalItems as $additionalItem)
                        <div class="space-y-1">
                            <a href="{{ route('item.show', [$additionalItem->categories->first()->slug, $additionalItem->slug]) }}"
                               class="">
                                <img class="w-40 h-40 object-contain" src="{{Storage::url($additionalItem->image->path)}}"
                                     alt="{{$additionalItem->name}}" title="{{$additionalItem->name}}">
                            </a>
                            <a class="font-bold"
                               href="{{ route('item.show', [$additionalItem->categories->first()->slug, $additionalItem->slug]) }}"
                               class="">
                                {{ $additionalItem->name }}
                            </a>
                            <div class="">
                                {{ __('price') }}: {{ renderPrice($additionalItem->price) }}
                            </div>
                            <livewire:cart.create :item="$additionalItem" :key="'cart-create-'.$item->id"/>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>

@endsection