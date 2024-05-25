<?php

namespace App\Http\Controllers\Front;

use App\Events\TokenEvent;
use App\Http\Controllers\Controller;
use App\Repository\userRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class   TokenController extends Controller
{
    public function __construct(public userRepo $userRepo)
    {
    }

    public function index(Request $request)
    {
        if ($request->header('info-user')) {

            $user = $this->userRepo->getIdName($request->header('info-user'));
            event(new TokenEvent($request  , $user));
            return true ;

            $count = Cache::increment($user->uuid_name, $request->click);

            $user->t_balance()->update([
                'amount' => $count
            ]);
        }
    }

    public function getToken(Request $request)
    {
        if ($request->header('info-user')) {
            $user = $this->userRepo->getIdName($request->header('info-user'));
            dd(Cache::get($user->uuid_name ));
            dd(Cache::forget($user->uuid_name));
        }
    }
}
