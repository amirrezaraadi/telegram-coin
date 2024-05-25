<?php

namespace App\Models\Pivot;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PlayerRobot extends Pivot
{
    protected $table = 'player_robot';

    protected $fillable = ['player_id', 'robot_id'];

    public static function getPlayerId($id)
    {
        return parent::query()->where('player_id',$id)->first();
    }
}
