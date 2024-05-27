<?php

namespace App\Models\Manager;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Energy extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'title',
        'size',
        'amount',
        'is_default',
    ];

    protected $casts = [
        'publish_at' => 'timestamp'
    ];
    protected $hidden = [
        'deleted_at' ,
        'publish_at' ,
        'created_at' ,
        'updated_at',
        'is_default',
    ];

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'player_energy',
            'energy_id',
            'player_id');
    }
}
