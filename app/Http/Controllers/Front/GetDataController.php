<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Pivot\PlayerEnergy;
use App\Repository\userRepo;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class GetDataController extends Controller
{
    public function __construct(public userRepo $userRepo)
    {
    }

    public function index(Request $request)
    {
        $data = $request->json()->all();
        $user = $this->userRepo->getDatauser($data['id']);
        if (is_null($user)) {
            return response()->json(['message' => 'not found user'], 401);
        }
        $publish_t_balance_timestamp = date("Y-m-d H:i:s", $data['time']);
        $count_amount = $user->t_balance()->pluck('count_amount')->first();
        $sum_count_amount = $count_amount + $data['click'];
        $user->t_balance()->update([
            'amount' => $data['click'],
            'count_amount' => $sum_count_amount,
            'publish_at' => $publish_t_balance_timestamp]);
        $energy_user = $user->getEnergyUserId;
        $recharging_user = $user->getRechargingUserId;
        $last_energy = $data['lastEnergy'];
        $energy = $last_energy * $recharging_user->unit; // return  15
        $estimate_refill_timestamp = Carbon::createFromTimestamp($data['energy_time']);
        $time_now = Carbon::now()->timestamp;
        $seconds_diff = $time_now - $estimate_refill_timestamp->timestamp;
        $timestamp_full = $recharging_user->unit * $seconds_diff + $energy;
        $res = min($energy_user->size, $timestamp_full);
        return response()->json(['res' => $res, 'status' => 'success'], 200);
    }
}
