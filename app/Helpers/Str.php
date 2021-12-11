<?php

if (!function_exists('fullName')) {
    function fullName(string $name, string $surname): string
    {
        return ucfirst(strtolower($surname)) . ' ' . ucfirst(strtolower($name));
    }
}

if (!function_exists('shortName')) {
    function shortName(string $name, string $surname): string
    {
        return ucfirst(strtolower($surname)) . ' ' . ucfirst(mb_substr($name, 0, 1)) . '.';
    }
}

if (!function_exists('wordsFilter')) {
    function wordsFilter(?string $words, array $filters = [], string $method = 'startsWith', string $delimiter = ' '): string
    {
        return \Illuminate\Support\Str::of($words)
            ->explode($delimiter)
            ->filter(
                fn($word) => \Illuminate\Support\Str::$method($word, $filters)
            )
            ->implode($delimiter);
    }
}