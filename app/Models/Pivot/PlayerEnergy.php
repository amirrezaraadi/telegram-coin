<?php

namespace App\Models\Pivot;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PlayerEnergy extends Pivot
{
    protected $table = 'player_energy';

    /*
     * Relationships
     */
    protected $fillable = ['player_id', 'energy_id', 'energyLast' , 'energy_time' ];

    public static function getPlayerId($id)
    {
        return parent::query()->where('player_id', $id)->first();
    }
}
