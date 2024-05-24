<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Manager\Energy;
use App\Repository\energyRepo;
use App\Repository\multiple_touchesRepo;
use App\Repository\rechargingRepo;
use App\Repository\trophyRepo;
use App\Repository\userRepo;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct(public energyRepo           $energyRepo,
                                public trophyRepo           $trophyRepo,
                                public multiple_touchesRepo $multiple_touchesRepo,
                                public rechargingRepo       $rechargingRepo,

    )
    {
    }

    public function auth(Request $request , $int)
    {
        $user = resolve(userRepo::class)->getIdName($int);
        if (is_null($user)) {
            $save = resolve(userRepo::class)->create($int);
            $save->t_balance()->create(['amount' => 0]);
            $trophyRepo = $this->trophyRepo->getFindId(1);
            $multiple = $this->multiple_touchesRepo->getFindId(1);
            $energy = $this->energyRepo->getFindId(1);
            $recharging = $this->rechargingRepo->getFindId(1);
            $save->energy_many()->attach($energy->id);
            $save->trophy_many()->attach($trophyRepo->id);
            $save->multi_touche_many()->attach($multiple->id);
            $save->recharging_many()->attach($multiple->id);
            return response()->json(['user' => $save, 'status' => 'create new player '], 200);
        }
        return $user;
    }
}
