<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Manager\Energy;
use App\Models\Manager\Trophy;
use App\Models\Pivot\PlayerEnergy;
use App\Models\Pivot\PlayerTask;
use App\Repository\taskRepo;
use App\Repository\userRepo;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GetDataController extends Controller
{
    public function __construct(public userRepo $userRepo, public taskRepo $taskRepo)
    {
    }


    public function get_tasks(Request $request)
    {
        if ($request->header('info-user')) {
            $user = $this->userRepo->getIdName($request->header('info-user'));
            return $user->undoneTasks();
        }
    }

    public function post_tasks(Request $request)
    {
        if ($request->header('info-user')) {
            $user = $this->userRepo->getIdName($request->header('info-user'));
            $data_task_id = $request->json()->get('task_id');
            $task = PlayerTask::query()->where('task_id', $data_task_id)->first();
            return $task->update(['is_state' => 1]);
        }
    }

    public function get_trophies(Request $request)
    {
        if ($request->header('info-user')) {
            $user = $this->userRepo->getIdName($request->header('info-user'));
            $check_id_trophy = $user->getTrophyUserId;
            return Trophy::query()
                ->where('id', '>', $check_id_trophy->id)
                ->select(['title', 'amount'])
                ->get();
        }
    }
}
