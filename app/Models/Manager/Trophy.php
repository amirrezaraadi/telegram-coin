<?php

namespace App\Models\Manager;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


class Trophy extends Model
{
    use HasFactory ;

    protected $fillable = ['title', 'is-default' , 'amount'];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'player_id');
    }


}
