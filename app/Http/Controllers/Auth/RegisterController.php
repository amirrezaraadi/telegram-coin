<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Manager\Energy;
use App\Models\Manager\MultipleTouches;
use App\Models\Manager\Recharging;
use App\Models\Manager\Trophy;
use App\Models\Pivot\PlayerEnergy;
use App\Models\Pivot\PlayerMulti;
use App\Models\Pivot\PlayerRecharging;
use App\Models\Pivot\PlayerTask;
use App\Models\Pivot\PlayerTrophy;
use App\Repository\energyRepo;
use App\Repository\multiple_touchesRepo;
use App\Repository\rechargingRepo;
use App\Repository\taskRepo;
use App\Repository\trophyRepo;
use App\Repository\userRepo;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct(public energyRepo           $energyRepo,
                                public trophyRepo           $trophyRepo,
                                public multiple_touchesRepo $multiple_touchesRepo,
                                public rechargingRepo       $rechargingRepo,
                                public taskRepo             $taskRepo,

    )
    {
    }

    public function auth_auth(Request $request, $int)
    {
        $user = resolve(userRepo::class)->getIdName($int);
        if (is_null($user)) {
            $save = resolve(userRepo::class)->create($int);
            $level_up = PlayerMulti::query()->where('player_id', $save->id)->first();
            $level = $this->multiple_touchesRepo->getNameCheck($level_up->multiple_touche_id);
            $this->syncTaskBeUser($save->id);
            $data = $this->getUserCustom($save);
            $save ['upgrade'] =
                ['energyLimit' => $data['energyLimit'],
                    'energySpeed' => $data['energySpeed'],
                    'multitap' => $data['multitap'],
                    'userNextTrophy' => $data['userNextTrophy'],
                    'userTotalBalance' => $data['userTotalBalance'],
                ];
            return response()->json(['user' => $user, 'status' => 'create new player '], 200);
        }
        $data = $this->getUserCustom($user);
        $user ['upgrade'] =
            ['energyLimit' => $data['energyLimit'],
                'energySpeed' => $data['energySpeed'],
                'multitap' => $data['multitap'],
                'userNextTrophy' => $data['userNextTrophy'],
                'userTotalBalance' => $data['userTotalBalance'],
            ];

        return response()->json(['user' => $user, 'status' => 'create new player '], 200);
    }


    public function auth(Request $request, $int)
    {
        $user = resolve(userRepo::class)->getIdName($int);
        if (is_null($user)) {
            $save = resolve(userRepo::class)->create($int);

            $level_up = PlayerMulti::query()->where('player_id', $save->id)->first();
            $level = $this->multiple_touchesRepo->getNameCheck($level_up->multiple_touche_id);
            $this->syncTaskBeUser($save->id);
            $data = $this->getUserCustom($save);
            $save ['upgrade'] =
                ['energyLimit' => $data['energyLimit'],
                    'energySpeed' => $data['energySpeed'],
                    'multitap' => $data['multitap'],
                    'userNextTrophy' => $data['userNextTrophy'],
                    'userTotalBalance' => $data['userTotalBalance'],
                ];
            return response()->json(['user' => $save, 'status' => 'create new player '], 200);
        }
        $data = $this->getUserCustom($user);
        $user ['upgrade'] =
            ['energyLimit' => $data['energyLimit'],
                'energySpeed' => $data['energySpeed'],
                'multitap' => $data['multitap'],
                'userNextTrophy' => $data['userNextTrophy'],
                'userTotalBalance' => $data['userTotalBalance'],
            ];

        return response()->json(['user' => $user, 'status' => 'create new player '], 200);
    }

    public function syncTaskBeUser($id)
    {
        $tasks = $this->taskRepo->getAllId();
        foreach ($tasks as $task) {
            PlayerTask::query()->create([
                'player_id' => $id,
                'task_id' => $task->id,
            ]);
        }
    }

    public function getUserCustom($save)
    {
        $id = 1;

        $energyLimit = PlayerEnergy::query()->where('id', $save->id)->first();
        $upgrade_energy = Energy::query()->where('id', $energyLimit->energy_id)->first()->size ?? null;
        $energyLimit->update(['energyLast' => $upgrade_energy]);
        $upgrade_energyLimit = Energy::query()->where('id', ($energyLimit->energy_id + $id))->first()->amount ?? null;


        $energySpeed = PlayerRecharging::query()->where('id', $save->id)->first();
        $upgrade_energySpeed = Recharging::query()->where('id', ($energySpeed->recharging_id + $id))->first()->amount ?? null;


        $multitap = PlayerMulti::query()->where('id', $save->id)->first();
        $upgrade_multitap = MultipleTouches::query()->where('id', ($multitap->multiple_touche_id + $id))->first()->amount ?? null;


        $trophy = PlayerTrophy::query()->where('id', $save->id)->first();
        $userNextTrophy = Trophy::query()->where('id', ($trophy->trophy_id + $id))->first()->amount ?? null;

        $userTotalBalance = $save->t_balance->first()->count_amount ?? null;

        return [
            'energyLimit' => $upgrade_energyLimit,
            'energySpeed' => $upgrade_energySpeed,
            'multitap' => $upgrade_multitap,
            'userNextTrophy' => $userNextTrophy,
            'userTotalBalance' => $userTotalBalance,

        ];
    }

}
