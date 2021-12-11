<?php

namespace App\Macroses;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Lang;

class ComponentAttributeBagMixin
{

    public function prop()
    {   
        return function(string $action): ?string
        {
            $value = $this->wire($action)->value();
            return !(empty($value)) ? $value : null;
        };
    }

    public function lang()
    {   
        return function(string $action): ?string
        {
            return Lang::getOrNull($this->prop($action));
        };
    }

    public function firstProp()
    {   
        return function(array $keys): ?string
        {
            foreach($keys as $key){
                $value = $this->prop($key);
                if($value){
                    return $value;
                }
            }
            return null;
        };
    }

    public function icon()
    {   
        return function(string $action): string
        {
            $icons = [
                'archivate' => 'archive',
                'batch' => 'layer-group',
                'comment' => 'tag',
                'create' => 'plus',
                'delay' => 'stopwatch',
                'delivery' => 'truck',
                'destroy' => 'trash',
                'email' => 'at',
                'login' => 'sign-in-alt',
                'name' => 'user',
                'password' => 'key',
                'password_confirmation' => 'key',
                'phone' => 'phone-alt',
                'qty' => 'cubes',
                'refresh' => 'sync-alt',
                'sid' => 'tag',
                'store' => 'plus',
                'submit' => 'plus',
                'surname' => 'user-friends',
                'update' => 'check',
            ];
            $value = $this->wire($action)->value();
            $method = explode('(', $value)[0];
            return $this['icon'] ?? $icons[$method] ?? '';
        };
    }

    public function type()
    {   
        return function(): ?string
        {
            $types = [
                'password_confirmation' => 'password',
            ];
            return $types[$this->wire('model')->value()] ?? $this['type'];
        };
    }

    public function placeholder()
    {
        return function(): string
        {
            return Lang::getOrNull($this['placeholder'])
                ?? Lang::getOrNull(Str::of($this->prop('model'))->explode('.')->last())
                ?? '';
        };
        
    }

    public function onlyClasses()
    {
        return function(array $matches = []): ?string
        {
            $classes = Str::of($this['class']);
            $splits = collect($matches)->map(
                fn($match) => $classes->match('/\b'.$match.'\S*\b/')
            );
            return $splits->implode(' ');
        };
    }

    public function withoutClasses()
    {
        return function(array $matches = []): ?string
        {
            $classes = Str::of($this['class']);
            $splits = collect($matches)->map(
                fn($match) => $classes->remove($classes->match('/\b'.$match.'\S*\b/'))
            );
            return $splits->first();
        };
    }
    
}