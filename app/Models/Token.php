<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Token extends Model
{
    use HasFactory;

    protected $fillable = ['click', 'published_at', 'player_id'];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'player_id');
    }

    protected $casts = [
        'published_at' => 'timestamp'
    ];
}
