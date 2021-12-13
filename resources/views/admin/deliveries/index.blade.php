@extends('admin.layouts.app')

@section('admin-content')

	<div class="divide-y">
		<div class="pb-4">
			<livewire:admin.deliveries.create />
		</div>
		<div class="pt-4">
			<livewire:admin.deliveries.index />
		</div>
	</div>

@endsection