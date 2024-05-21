<?php

namespace App\Models\Pivot;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PlayerEnergy extends Pivot
{
    protected $table = 'player_energy';

    /*
     * Relationships
     */
    protected $fillable = ['player_id', 'energy_id'];
}
