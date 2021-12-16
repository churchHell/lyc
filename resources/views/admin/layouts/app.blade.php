@extends('layouts.empty')

@section('body')

	<div class="grid grid-cols-12 h-full">

		<div class="col-span-1 text-white bg-blueGray-800 p-4 flex flex-col">
			<a href="{{ route('admin.orders.index') }}">{{ __('orders') }}</a>
			<a href="{{ route('admin.categories') }}">{{ __('categories') }}</a>
			<a href="{{ route('admin.items.index') }}">{{ __('items') }}</a>
			<a href="{{ route('admin.properties.index') }}">{{ __('properties') }}</a>
			<a href="{{ route('admin.units.index') }}">{{ __('units') }}</a>
			<a href="{{ route('admin.settings.index') }}">{{ __('settings') }}</a>
			<a href="{{ route('admin.pages.index') }}">{{ __('pages') }}</a>
			<a href="{{ route('admin.deliveries.index') }}">{{ __('deliveries') }}</a>
			<a href="{{ route('admin.users.index') }}">{{ __('users') }}</a>
			<a href="{{ route('admin.statuses.index') }}">{{ __('statuses') }}</a>
		</div>

		<div class="col-span-11 pl-6 pr-2 py-4">
			@yield('admin-content')
		</div>

	</div>

@endsection
