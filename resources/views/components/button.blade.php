@props(['success' => 'success', 'error' => 'error'])

<button 
	{{ $attributes }}
	title="{{ $attributes->prop('title') ?? $attributes->lang('click') ?? $slot }}"
>

	<span>{{ !empty($slot->toHtml()) ? $slot : __($attributes->wire('click')->value) }}</span>

	<i 
		wire:loading 
		wire:loading.attr="disabled"
		wire:target="{{ $attributes->firstProp(['target', 'click']) }}"
		class="preloader fas fa-spinner animate-spin"
	></i>

	<i 
		x-data="{show: false}"
		x-show.transition.1000ms="show"
		x-init="@this.on('{{$success}}', () => {show = true; setTimeout(() => {show = false;}, 2000)})"
		class="fas fa-check"
		style="display: none;"
	></i>

	<i 
		x-data="{show: false}"
		x-show.transition.1000ms="show"
		x-init="@this.on('{{$error}}', () => {show = true; setTimeout(() => {show = false;}, 2000)})"
		class="fas fa-times text-red-800"
		style="display: none;"
	></i>

</button>