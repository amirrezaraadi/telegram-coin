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
    protected $hidden = [
        'updated_at',
        'created_at',
        'deleted_at',
        'is_default',
        'publish_at',
        'pivot',
        'laravel_through_key',
    ];
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'player_id');
    }
}
