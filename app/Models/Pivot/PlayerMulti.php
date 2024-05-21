<?php

namespace App\Models\Pivot;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PlayerMulti extends Pivot
{
    protected $table = 'player_multiple';

    /*
     * Relationships
     */
    protected $fillable = ['player_id', 'multiple_touche_id'];
}
