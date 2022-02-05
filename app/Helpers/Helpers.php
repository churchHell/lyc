<?php

if (!function_exists('isSynced')) {
    function isSynced(array $result): bool
    {
        return count($result['attached']) > 0 || count($result['updated']) > 0;
    }
}

if (!function_exists('isUnsynced')) {
    function isUnsynced(array $result): bool
    {
        return count($result['detached']) > 0;
    }
}

if (!function_exists('dateToShow')) {
    function dateToShow(string $date): string
    {
        return \Carbon\Carbon::make($date)->format('d.m H:i');
    }
}

if (!function_exists('renderPrice')) {
    function renderPrice(?int $price)
    {
        return number_format($price/100, 2, '.', ' ') . ' BYN';
    }
}

if (!function_exists('renderPhone')) {
    function renderPhone(string $phone): string
    {
        return $phone;
        $result = '';
        $phone = str_split(strrev($phone));

        dd(array_slice($phone, 2), $phone);
        // return
    }
}

if (!function_exists('renderQty')) {
    function renderQty(int $qty): string
    {
        return $qty > 0 ? __('yes') : __('no');
    }
}

if (!function_exists('getCookie')) {
    function getCookie(string $key): ?string
    {
//        dd($key, \Illuminate\Support\Facades\Cookie::has($key));
        return \Illuminate\Support\Facades\Cookie::get($key);
    }
}

if (!function_exists('setCookie')) {
    function setCookie(string $key, $value)
    {
        return \Illuminate\Support\Facades\Cookie::queue(\Illuminate\Support\Facades\Cookie::forever($key, $value));
    }
}

if (!function_exists('getCartId')) {
    function getCartId(): ?int
    {
        return auth()->check() ? auth()->user()->cart_id : getCookie('cartId');
    }
}

if (!function_exists('str')) {
    function str(string $string): \Illuminate\Support\Stringable
    {
        return \Illuminate\Support\Str::of($string);
    }
}

// Bindings

if (!function_exists('cartRepository')) {
    function cartRepository()
    {
        return app(\App\Repositories\CartRepositoryInterface::class);
    }
}

if (!function_exists('cartService')) {
    function cartService()
    {
        return app(\App\Services\CartServiceInterface::class);
    }
}

if (!function_exists('alphaService')) {
    function alphaService()
    {
        return app(\App\Services\AlphaServiceInterface::class);
    }
}

if (!function_exists('promocodeService')) {
    function promocodeService()
    {
        return app(\App\Services\PromocodeServiceInterface::class);
    }
}