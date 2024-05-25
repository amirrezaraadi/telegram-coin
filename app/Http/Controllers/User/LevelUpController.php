<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pivot\PlayerEnergy;
use App\Models\Pivot\PlayerMulti;
use App\Models\Pivot\PlayerRecharging;
use App\Models\Pivot\PlayerRobot;
use App\Repository\energyRepo;
use App\Repository\multiple_touchesRepo;
use App\Repository\rechargingRepo;
use App\Repository\trophyRepo;
use App\Repository\userRepo;
use Illuminate\Http\Request;

class LevelUpController extends Controller
{

    public function __construct(
        public userRepo             $userRepo,
        public energyRepo           $energyRepo,
        public trophyRepo           $trophyRepo,
        public rechargingRepo       $rechargingRepo,
        public multiple_touchesRepo $multiple_touchesRepo)
    {
    }
    public function energy(Request $request)
    {
        $header = $request->header('info-user');
        $user = $this->userRepo->getIdName($header);
        $energyId = PlayerEnergy::getPlayerId($user->id);
        $result = $this->energyRepo->getNameNext($energyId->energy_id , $user);

        if ($result === false) {
            return response()->json(['message' => 'The last step'],401);
        }
        return $result ;
    }

//    public function multi(Request $request)
//    {
//        $header = $request->header('info-user');
//        $user = $this->userRepo->getIdName($header);
//        $multiId = PlayerMulti::getPlayerId($user->id);
//        $result = $this->multiple_touchesRepo->getNameNext($multiId->multiple_touche_id , $user);
//        if ( $result === false ) {
//            return response()->json(['message' => 'The last step'],401);
//        }
//        return $result ;
//    }

    public function recharging(Request $request)
    {
        $header = $request->header('info-user');
        $user = $this->userRepo->getIdName($header);
        $recharging = PlayerRecharging::getPlayerId($user->id);
        $result = $this->rechargingRepo->getNameNext($recharging->recharging_id , $user);
        if ( $result === false ) {
            return response()->json(['message' => 'The last step'],401);
        }
        return $result ;
    }
    public function robot(Request $request)
    {
        $header = $request->header('info-user');
        $user = $this->userRepo->getIdName($header);
        $recharging = PlayerRobot::getPlayerId($user->id);
        $result = $this->rechargingRepo->getNameNext($recharging->recharging_id , $user);
        if ( $result === false ) {
            return response()->json(['message' => 'The last step'],401);
        }
        return $result ;
    }
}
