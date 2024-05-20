<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Manager\Energy;
use App\Models\Manager\MultipleTouches;
use App\Models\Manager\TBalance;
use App\Models\Manager\Trophy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable
//        , SoftDeletes
        ;


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

    public function t_balance():HasMany
    {
        return $this->hasMany(TBalance::class , 'player_id');
    }
    public function t_energy():HasMany
    {
        return $this->hasMany(Energy::class , 'player_id');
    }
    public function trophy():HasMany
    {
        return $this->hasMany(Trophy::class , 'player_id');
    }
    public function multi_touche():HasMany
    {
        return $this->hasMany(MultipleTouches::class , 'player_id');
    }

}
