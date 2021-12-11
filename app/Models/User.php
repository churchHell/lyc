<?php

namespace App\Models;

use App\Casts\Name;
use App\Models\Traits\Phone;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany, HasOne};
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, Phone;

    protected $fillable = [
        'name',
        'surname',
        'phone',
        'email',
        'password',
        'cart_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime', 'name' => Name::class, 'surname' => Name::class
    ];

    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    public function isAdmin(): bool
    {
        return $this->role_id == Role::ADMIN;
    }

    public function hasRole(string $role): bool
    {
        return $this->role_id == constant(Role::class.'::'.strtoupper($role));
    }

    
}
