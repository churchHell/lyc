@component('mail::message')

{{ __('order-created') }} #{{ $order->id }}

@component('mail::button', ['url' => route('admin.orders.index')])
{{ __('orders') }}
@endcomponent

{{ config('app.name') }}
@endcomponent
