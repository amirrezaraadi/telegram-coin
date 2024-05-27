<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Pivot\PlayerEnergy;
use App\Repository\userRepo;
use Illuminate\Http\Request;

class GetDataController extends Controller
{
    public function __construct(public userRepo $userRepo)
    {
    }

    public function index(Request $request)
    {
        $data = $request->json()->all();

        $user = $this->userRepo->getDatauser($data['id'], $data['click'], $data['time']);
        if (is_null($user)) {
            return response()->json(['message' => 'not found user'], 401);
        }
        $publish_t_balance_timestamp = date("Y-m-d H:i:s", $data['time']);
        $user->t_balance()->update(['amount' => $data['click'], 'publish_at' => $publish_t_balance_timestamp]);

        $publish_estimate_refill_timestamp = date("H:i:s", $data['estimateRefill']);

        $energy = $user->getEnergyUserId;
        $recharging = $user->getRechargingUserId ;
        $last_energy = $data['lastEnergy'];


        return response()->json(['message' => 'I received it correctly', 'status' => 'success'], 200);
    }
}
