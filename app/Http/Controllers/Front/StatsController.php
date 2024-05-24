<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class StatsController extends Controller
{

    public function __invoke(Request $request)
    {
        Redis::set('amirreza' , 'raadi');

        dd(Redis::get('amirreza'));
    }
}
