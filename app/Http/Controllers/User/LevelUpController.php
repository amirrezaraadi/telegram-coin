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
use App\Repository\robotRepo;
use App\Repository\trophyRepo;
use App\Repository\userRepo;
use http\Env\Response;
use Illuminate\Http\Request;

class LevelUpController extends Controller
{

    public function __construct(
        public userRepo             $userRepo,
        public energyRepo           $energyRepo,
        public trophyRepo           $trophyRepo,
        public rechargingRepo       $rechargingRepo,
        public robotRepo            $robotRepo,
        public multiple_touchesRepo $multiple_touchesRepo)
    {
    }

    public function energy(Request $request)
    {
        $header = $request->header('info-user');
        $user = $this->userRepo->getIdName($header);
        $energyId = PlayerEnergy::getPlayerId($user->id);
        $id = $energyId->energy_id + 1;
        $check = $this->energyRepo->getFindIdName($id);
        if (is_null($check)) {
            return 'not id ';
        }
        return $check;
    }

    public function recharging(Request $request)
    {
        $header = $request->header('info-user');
        $user = $this->userRepo->getIdName($header);
        $recharging = PlayerRecharging::getPlayerId($user->id);
        $id = $recharging->recharging_id + 1;
        $check = $this->rechargingRepo->getFindIdName($id);
        if (is_null($check)) {
            return response()->json(['message' => 'The last step'], 401);
        }
        return $check;
    }

    public function robot(Request $request)
    {
        $header = $request->header('info-user');
        $user = $this->userRepo->getIdName($header);
        $recharging = PlayerRobot::getPlayerId($user->id);
        $rechargingId = $recharging->robot_id ?? 0;
        if ($rechargingId === 0) {
            $id = $rechargingId + 1;
        }
        $id_robot = $rechargingId ?? $id;
        $result = $this->robotRepo->getFindIdName($id_robot);
        if (is_null($result)) {
            return response()->json(['message' => 'The last step'], 401);
        }
        return $result;
    }

    public function recharging_up(Request $request)
    {
        $header = $request->header('info-user');
        $user = $this->userRepo->getIdName($header);
        $recharging = PlayerRecharging::getPlayerId($user->id);
        $result = $this->rechargingRepo->getNameNext($recharging->recharging_id, $user);
        if ($result === false) {
            return response()->json(['message' => 'The last step'], 401);
        }
        return $result;
    }

    public function energy_up(Request $request)
    {
        $header = $request->header('info-user');
        $user = $this->userRepo->getIdName($header);
        $energyId = PlayerEnergy::getPlayerId($user->id);
        $result = $this->energyRepo->getNameNext($energyId->energy_id, $user);

        if ($result === false) {
            return response()->json(['message' => 'The last step'], 401);
        }
        return $result;
    }


    public function robot_up(Request $request)
    {
        $header = $request->header('info-user');
        $user = $this->userRepo->getIdName($header);
        $recharging = PlayerRobot::getPlayerId($user->id);
        $rechargingId = $recharging->robot_id ?? 0;
        $result = $this->robotRepo->getNameNext($rechargingId, $user);
        if ($result === false) {
            return response()->json(['message' => 'The last step'], 401);
        }
        return $result;
    }

    public function multi(Request $request)
    {
        $header = $request->header('info-user');
        $user = $this->userRepo->getIdName($header);
        $multiId = PlayerMulti::getPlayerId($user->id);
        $id = $multiId->multiple_touche_id + 1;
        $result = $this->multiple_touchesRepo->getNameFirst($id);

        if (is_null($result )) {
            $check = $this->multiple_touchesRepo->getNameCheck($multiId->multiple_touche_id);
            return $check;
        }
        return $result;

    }

    public function multi_up(Request $request)
    {
        $header = $request->header('info-user');
        $user = $this->userRepo->getIdName($header);
        $multiId = PlayerMulti::getPlayerId($user->id);
        $result = $this->multiple_touchesRepo->getNameNext($multiId->multiple_touche_id, $user);
        if ($result === false) {
            return response()->json(['message' => 'The last step'], 401);
        }
        return $result;
    }
}
