<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repository\energyRepo;
use App\Repository\multiple_touchesRepo;
use App\Repository\trophyRepo;
use Illuminate\Http\Request;

class InfoUserController extends Controller
{
    public function __construct(public energyRepo           $energyRepo,
                                public trophyRepo           $trophyRepo,
                                public multiple_touchesRepo $multiple_touchesRepo)
    {
    }
    public function __invoke(Request $request)
    {
       $header = $request->header('info-user');
       dd($header);
    }
}
