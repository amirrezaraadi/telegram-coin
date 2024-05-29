<?php

namespace App\Models\Manager;

use App\Models\Pivot\PlayerTask;
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
    protected $hidden = [
        'laravel_through_key'
    ];
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function taskUsers()
    {
        return $this->hasMany(PlayerTask::class, 'task_id');
    }

}
