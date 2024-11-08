<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use Notifiable, HasFactory, HasApiTokens;

    protected $fillable = [
        'name',
        'username',
        'password',
        'role',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed'
        ];
    }
}