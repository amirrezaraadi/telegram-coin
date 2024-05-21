<?php

namespace App\Models\Pivot;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PlayerTrophy extends Pivot
{
    protected $table = 'player_trophy';

    /*
     * Relationships
     */
    protected $fillable = ['player_id', 'trophy_id'];
}
