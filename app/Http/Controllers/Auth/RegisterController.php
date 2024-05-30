<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Manager\Energy;
use App\Models\Manager\MultipleTouches;
use App\Models\Pivot\PlayerMulti;
use App\Models\Pivot\PlayerTask;
use App\Repository\energyRepo;
use App\Repository\multiple_touchesRepo;
use App\Repository\rechargingRepo;
use App\Repository\taskRepo;
use App\Repository\trophyRepo;
use App\Repository\userRepo;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct(public energyRepo           $energyRepo,
                                public trophyRepo           $trophyRepo,
                                public multiple_touchesRepo $multiple_touchesRepo,
                                public rechargingRepo       $rechargingRepo,
                                public taskRepo             $taskRepo,

    )
    {
    }

//    public function auth(Request $request, $int)
//    {
//        $user = resolve(userRepo::class)->getIdName($int);
//        if (is_null($user)) {
//            $save = resolve(userRepo::class)->create($int);
//            $save->t_balance()->create(['amount' => 0 , 'count_amount' => 0]);
//            $trophyRepo = $this->trophyRepo->getFindId(1);
//            $energy = $this->energyRepo->getFindId(1);
//            $recharging = $this->rechargingRepo->getFindId(1);
//            $multiple_touches = $this->multiple_touchesRepo->getFindId(1);
//            $save->energy_many()->attach($energy->id);
//            $save->trophy_many()->attach($trophyRepo->id);
//            $save->recharging_many()->attach($recharging->id);
//            $save->multi_touche_many()->attach($multiple_touches->id);
//            $level_up = PlayerMulti::query()->where('player_id' , $save->id)->first();
//            $level = $this->multiple_touchesRepo->getNameCheck( $level_up->multiple_touche_id);
//            return response()->json(['user' => $save, 'level' => $level ,  'status' => 'create new player '], 200);
//        }
//
//        $level_up = PlayerMulti::query()->where('player_id' , $user->id)->first();
//        $level = $this->multiple_touchesRepo->getNameCheck( $level_up->multiple_touche_id);
//        return response()->json(['user' => $user , 'level' => $level ,  'status' => 'create new player '], 200);
//    }

    public function auth(Request $request, $int)
    {
        $user = resolve(userRepo::class)->getIdName($int);
        if (is_null($user)) {
            $save = resolve(userRepo::class)->create($int);
            $level_up = PlayerMulti::query()->where('player_id', $save->id)->first();
            $level = $this->multiple_touchesRepo->getNameCheck($level_up->multiple_touche_id);
            $this->syncTaskBeUser($save->id);
            return response()->json(['user' => $save, 'level' => $level, 'status' => 'create new player '], 200);
        }

//        $level_up = PlayerMulti::query()->where('player_id', $user->id)->first();
//        $level = $this->multiple_touchesRepo->getNameCheck($level_up->multiple_touche_id);
        $user->trophy_many->pluck('amount')->first() ;
        $user->t_balance->pluck('amount')->first();
        return response()->json(['user' => $user,  'status' => 'create new player '], 200);
    }

    public function syncTaskBeUser($id)
    {
        $tasks = $this->taskRepo->getAllId();
        foreach ($tasks as $task) {
            PlayerTask::query()->create([
                'player_id' => $id,
                'task_id' => $task->id,
            ]);
        }
    }

}
