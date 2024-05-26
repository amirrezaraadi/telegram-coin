<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repository\userRepo;
use Illuminate\Http\Request;

class GetDataController extends Controller
{
    public function __construct(public userRepo $userRepo)
    {
    }

    public function index(Request $request)
    {
        $datas = $request->json()->all();
        foreach ($datas as $data) {
            $user = $this->userRepo->getDatauser($data['id'] , $data['click'] , $data['time']);
            if(is_null($user)) {
                return response()->json(['message' => 'not found user'],401);
            }
            $user->t_balance()->update(['amount' => $data['click'] , 'publish_at' => date("Y-m-d H:i:s", $data['time'])]);

        }
    }
}
