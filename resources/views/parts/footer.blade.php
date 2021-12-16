<footer class="py-8 border-t">
    <div class="container flex justify-between flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0">
        <div class="">
            {!! $settings->get('about')->value !!}
        </div>
        <div class="flex flex-col">
            <div>{{ __('contacts') }}</div>
            <div class="">{{ renderPhone($settings->get('phone1')->value) }}</div>
            <div class="">{{ renderPhone($settings->get('phone2')->value) }}</div>
            <div class="">{{ $settings->get('address1')->value }}</div>
        </div>
        <div class="flex flex-col space-y-1">
            @foreach($pages as $page)
                <a href="{{ route('page.index', [$page->slug]) }}" title="{{ $page->name }}" class="">{{ $page->name }}</a>
            @endforeach
        </div>
        <img src="{{ Storage::url('payments_min.jpg') }}" class="h-60" alt="">
    </div>
</footer>