<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repository\userRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class StatsController extends Controller
{
    public function __construct(
        public userRepo $userRepo  ,

    )
    {
    }

    public function __invoke(Request $request)
    {
        if ($request->header('info-user')) {
            $coinIUserId = $this->userRepo->getConeUserId($request->header('info-user'));
        }
        $totalPlayer = $this->userRepo->getAllUser();
        $dailyDays =  $this->userRepo->getDailyUser();
        $totalTouch =  $this->userRepo->getTotalTouch();
        $online_Player =  $this->userRepo->getOnlinePlayers();
        return response()->json([
            'totalTouch' => $totalTouch ,
            'totalShareBalance' => $coinIUserId ,
            'totalPlayer' => $totalPlayer,
            'dailyDays' => $dailyDays,
            'online_Player' => $online_Player,


        ],200);
    }
}
