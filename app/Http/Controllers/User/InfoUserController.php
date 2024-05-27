<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pivot\PlayerEnergy;
use App\Models\Pivot\PlayerMulti;
use App\Models\Pivot\PlayerRecharging;
use App\Models\Pivot\PlayerTrophy;
use App\Repository\energyRepo;
use App\Repository\multiple_touchesRepo;
use App\Repository\rechargingRepo;
use App\Repository\trophyRepo;
use App\Repository\userRepo;
use Illuminate\Http\Request;

class InfoUserController extends Controller
{
    public function __construct(
        public userRepo             $userRepo,
        public energyRepo           $energyRepo,
        public trophyRepo           $trophyRepo,
        public rechargingRepo       $rechargingRepo,
        public multiple_touchesRepo $multiple_touchesRepo)
    {}
    public function all(){
        return $this->trophyRepo->index() ;
    }
    public function trophy(Request $request)
    {
        $header = $request->header('info-user');
        $user = $this->userRepo->getIdName($header);
        $playerTrophy = PlayerTrophy::getPlayerId($user->id);
        return $this->trophyRepo->getNameFirst($playerTrophy->trophy_id);

    }

    public function energy(Request $request)
    {
        $header = $request->header('info-user');
        $user = $this->userRepo->getIdName($header);
        $energy = PlayerEnergy::getPlayerId($user->id);
        return $this->energyRepo->getNameFirst($energy->energy_id);
    }

    public function multi(Request $request)
    {
        $header = $request->header('info-user');
        $user = $this->userRepo->getIdName($header);
        $PlayerMulti = PlayerMulti::getPLayerId($user->id);
        return $this->multiple_touchesRepo->getNameFirst($PlayerMulti->multiple_touche_id);
    }

    public function t_balance(Request $request)
    {
        $header = $request->header('info-user');
        $user = $this->userRepo->getIdName($header);
        return $user->t_balance->select('amount')->first();
    }

    public function recharging(Request $request)
    {
        $header = $request->header('info-user');
        $user = $this->userRepo->getIdName($header);
        $recharging = PlayerRecharging::getPlayerId($user->id);
        return $this->rechargingRepo->getNameFirst($recharging->recharging_id);
    }
}
