<?php

namespace App\Models\Pivot;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PlayerTask extends Pivot
{
    protected $fillable = [
        'confirmation',
        'is_state',
        'player_id',
        'task_id',
    ];

    public function getUserId($id)
    {
        return parent::query()->where('player_id',$id)->first();

    }
}
