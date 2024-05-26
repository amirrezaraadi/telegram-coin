<?php

namespace App\Repository;

use App\Models\Pivot\PlayerRobot;
use App\Models\Robot;

class robotRepo
{


    public function idnex()
    {
        return Robot::query()->paginate();
    }

    public function create($data)
    {
        return Robot::query()->create([
            'title' => $data['title'],
            'hour' => $data['hour'],
            'amount' => $data['amount'],
                'token' => $data['token'],
        ]);
    }

    public function getFindId($id)
    {
        return Robot::query()->findOrFail($id);
    }
    public function getFindIdName($id)
    {
        return Robot::query()->where('id' , $id)->first();
    }
    public function update($data, $id)
    {
        return Robot::query()->where('id', $id)->update([
            'title' => $data['title'],
            'hour' => $data['hour'],
            'amount' => $data['amount'],
            'token' => $data['token'],
        ]);
    }

    public function delete($id)
    {
        return Robot::query()->where('id', $id)->delete();
    }

    public function getNameNext($id , $user)
    {
        $next = $id + 1;
        $result = Robot::query()->where('id', $next)->select(['id' , 'title', 'hour', 'token' , 'amount'])->first();
        if ( is_null($result )) {
            return false ;
        }
        $amount = $user->t_balance->pluck('amount')->first();
        $checkCache = $amount > $result->amount;
        if (! $checkCache) {
            return false;
        }
        $remaining = $amount - $result->amount;
        $table = PlayerRobot::getPlayerId($user->id) ;
        if(is_null($table)){
            PlayerRobot::query()->create([
                'player_id' => $user->id ,
                'robot_id' => $result->id ,
            ]);
            $save_user = $user->t_balance()->update(['amount' => $remaining]);

            return $result;
        }
        $table->update(['robot_id' => $result->id]);
        $save_user = $user->t_balance()->update(['amount' => $remaining]);

        return $result;
    }
}
