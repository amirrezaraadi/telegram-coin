<?php

namespace App\Models\Pivot;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PlayerRecharging extends Pivot
{
    protected $table = 'player_recharging';

    /*
     * Relationships
     */
    protected $fillable = ['player_id', 'recharging_id'];

    public static function getPlayerId($id)
    {
        return parent::query()->where('player_id' , $id)->first();
    }
}
