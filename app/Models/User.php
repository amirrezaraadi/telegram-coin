<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Jobs\TokenJob;
use App\Models\Manager\Energy;
use App\Models\Manager\MultipleTouches;
use App\Models\Manager\Recharging;
use App\Models\Manager\Task;
use App\Models\Manager\TBalance;
use App\Models\Manager\Trophy;
use App\Models\Pivot\PlayerEnergy;
use App\Models\Pivot\PlayerMulti;
use App\Models\Pivot\PlayerRecharging;
use App\Models\Pivot\PlayerTask;
use App\Models\Pivot\PlayerTrophy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable//        , SoftDeletes
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
        'updated_at',
        'created_at',
        'email_verified_at',
        'email',
        'phone',
        'wallet',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_seen' => 'datetime',
        'password' => 'hashed',

    ];

    public function t_balance(): HasMany
    {
        return $this->hasMany(TBalance::class, 'player_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $user->t_balance()->create(['amount' => 0, 'count_amount' => 0]);
            $user->energy_many()->attach(1);
            $user->trophy_many()->attach(1);
            $user->recharging_many()->attach(1);
            $user->multi_touche_many()->attach(1);
        });
    }

    public function multi_touche(): HasMany
    {
        return $this->hasMany(MultipleTouches::class, 'player_id');
    }

    public function token(): HasMany
    {
        return $this->hasMany(Token::class, 'player_id');
    }

    public function energy_many(): BelongsToMany
    {
        return $this->belongsToMany(Energy::class, 'player_energy',
            'player_id',
            'energy_id');
    }

    public function trophy_many(): BelongsToMany
    {
        return $this->belongsToMany(Trophy::class, 'player_trophy',
            'player_id',
            'trophy_id');
    }

    public function trophy(): BelongsToMany
    {
        return $this->belongsToMany(Trophy::class);
    }

    public function multi_touche_many(): BelongsToMany
    {
        return $this->belongsToMany(MultipleTouches::class, 'player_multiple',
            'player_id',
            'multiple_touche_id'
        );
    }

    public function recharging_many(): BelongsToMany
    {
        return $this->belongsToMany(Recharging::class, 'player_recharging',
            'player_id',
            'recharging_id'
        );
    }


    public function getEnergyUserId(): HasOneThrough
    {
        return $this->hasOneThrough(
            Energy::class,
            PlayerEnergy::class,
            'player_id',
            'id', // energy.id
            'id', // user.id
            'energy_id'
        );
    }

    public function getRechargingUserId(): HasOneThrough
    {
        return $this->hasOneThrough(
            Recharging::class,
            PlayerRecharging::class,
            'player_id',
            'id', // recharging.id
            'id', // user.id
            'recharging_id'
        );
    }

    public function getTrophyUserId(): HasOneThrough
    {
        return $this->hasOneThrough(
            Trophy::class,
            PlayerTrophy::class,
            'player_id',
            'id', // recharging.id
            'id', // user.id
            'trophy_id'
        );
    }

    public function getMultiUserId(): HasOneThrough
    {
        return $this->hasOneThrough(
            MultipleTouches::class,
            PlayerMulti::class,
            'player_id',
            'id', // recharging.id
            'id', // user.id
            'multiple_touche_id'
        );
    }

    public function getTaskUserId(): HasManyThrough
    {
        return $this->hasManyThrough(
            Task::class,
            PlayerTask::class,
            'player_id', // Foreign key on PlayerTask table...
            'id',        // Foreign key on Task table...
            'id',        // Local key on User table...
            'task_id'    // Local key on PlayerTask table...
        );
    }

// Create a new method to handle the query
    public function undoneTasks()
    {
        return $this->getTaskUserId()
            ->where('is_state', 0)
            ->select(['title', 'body', 'link', 'amount'])
            ->get();
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_user', 'player_id', 'task_id')
            ->withPivot('confirmation', 'is_state')
            ->withTimestamps();
    }

}
