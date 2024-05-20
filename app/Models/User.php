<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable , SoftDeletes;


    protected $fillable = [
        'uuid_name',
        'name',
        'email',
        'password',
        'id_tele',
        'phone',
        'ip',
        'remember_token',
        'last_seen',
        'wallet'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_seen' => 'datetime',
        'password' => 'hashed',
    ];
}
