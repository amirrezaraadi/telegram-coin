<?php

namespace App\Models\Manager;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MultipleTouches extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'title',
        'unit',
        'amount',
        'is_default',
    ];
    protected $casts = [
        'publish_at' => 'timestamp'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'player_id');
    }
}
