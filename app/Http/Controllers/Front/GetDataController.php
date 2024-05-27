<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Manager\Energy;
use App\Models\Pivot\PlayerEnergy;
use App\Repository\userRepo;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
        $user_amount = $user->t_balance()->pluck('amount')->first();
        $sum_count_amount = $count_amount + $data['click'];
        $sum_count_amount_user = $user_amount + $data['click'];
        $user->t_balance()->update([
            'amount' => $sum_count_amount_user,
            'count_amount' => $sum_count_amount,
            'publish_at' => $publish_t_balance_timestamp]);
        $energy_user = $user->getEnergyUserId;
        $recharging_user = $user->getRechargingUserId;


        $now_time_b = Carbon::now()->timestamp;
        $energy_time_b = $data['energy_time'];
        $new_energy_now = min($data['lastEnergy'] + ($now_time_b - $energy_time_b) * $recharging_user->unit, $energy_user->size);
        $save = PlayerEnergy::query()->where('player_id', $user->id)->update([
            'energyLast' => $new_energy_now ,
            'energy_time' => $energy_time_b ,
        ]);

        return response()->json(['res' => $new_energy_now, 'status' => 'success'], 200);
    }

    public function get_data(Request $request)
    {
        if ($request->header('info-user')) {
            $user = $this->userRepo->getIdName($request->header('info-user'));
            $recharging_user = $user->getRechargingUserId;
            $energy_user = $user->getEnergyUserId;
            $save = PlayerEnergy::query()->where('player_id' , $user->id)->first();
            $now_time_b = Carbon::now()->timestamp;
            $new_energy_now = min($save->energyLast + ($now_time_b - $save->energy_time ) * $recharging_user->unit, $energy_user->size);
            return response()->json(['energyLast' => $new_energy_now]);
        }

    }
}
