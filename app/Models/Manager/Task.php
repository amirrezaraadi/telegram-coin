<?php

namespace App\Models\Manager;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'link',
        'amount',
        'is_default',
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
