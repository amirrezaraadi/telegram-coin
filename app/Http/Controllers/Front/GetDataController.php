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

    public function post_tasks()
    {

    }

    public function get_tasks()
    {

    }
}
