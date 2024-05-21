<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pivot\PlayerEnergy;
use App\Models\Pivot\PlayerMulti;
use App\Models\Pivot\PlayerTrophy;
use App\Repository\energyRepo;
use App\Repository\multiple_touchesRepo;
use App\Repository\trophyRepo;
use App\Repository\userRepo;
use Illuminate\Http\Request;

class InfoUserController extends Controller
{
    public function __construct(
        public userRepo             $userRepo,
        public energyRepo           $energyRepo,
        public trophyRepo           $trophyRepo,
        public multiple_touchesRepo $multiple_touchesRepo)
    {
    }

    public function trophy(Request $request)
    {
        $header = $request->header('info-user');
        $user = $this->userRepo->getIdName($header);
        $playerTrophy = PlayerTrophy::query()->where('player_id', $user->id)->first();
        return  $this->trophyRepo->getNameFirst($playerTrophy->trophy_id);

    }

    public function energy(Request $request)
    {
        $header = $request->header('info-user');
        $user = $this->userRepo->getIdName($header);
        $energy = PlayerEnergy::query()->where('player_id' , $user->id)->first();
        return $this->energyRepo->getNameFirst($energy->energy_id);
    }

    public function t_balance(Request $request)
    {
        $header = $request->header('info-user');
        $user = $this->userRepo->getIdName($header);
        return $user->t_balance->select('amount')->first();
    }
    public function multi(Request $request)
    {
        $header = $request->header('info-user');
        $user = $this->userRepo->getIdName($header);
        $PlayerMulti = PlayerMulti::query()->where('player_id' , $user->id )->first();
        return $this->multiple_touchesRepo->getNameFirst($PlayerMulti->multiple_touche_id);
    }

}
