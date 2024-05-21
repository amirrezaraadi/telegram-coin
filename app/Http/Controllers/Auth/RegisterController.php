<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Manager\Energy;
use App\Repository\energyRepo;
use App\Repository\multiple_touchesRepo;
use App\Repository\trophyRepo;
use App\Repository\userRepo;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct(public energyRepo           $energyRepo,
                                public trophyRepo           $trophyRepo,
                                public multiple_touchesRepo $multiple_touchesRepo)
    {
    }

    public function auth(Request $request)
    {
        $input = $request->uuid_name;
        $user = resolve(userRepo::class)->getIdName($input);
        if (is_null($user)) {
            $save = resolve(userRepo::class)->create($request);
            $save->t_balance()->create(['amount' => 0]);
            $trophyRepo = $this->trophyRepo->getFindId(1);
            $multiple = $this->multiple_touchesRepo->getFindId(1);
            $energy = $this->energyRepo->getFindId(1);
            $save->energy_many()->attach($energy->id);
            $save->trophy_many()->attach($trophyRepo->id);
            $save->multi_touche_many()->attach($multiple->id);
            $token = $save->createToken($save->uuid_name  , ['server:update'])->plainTextToken;
            return response()->json(['token' => $token , 'status' => 'create new player '],200);
        }
        return $user ;
    }
}
