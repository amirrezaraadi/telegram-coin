<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repository\userRepo;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function auth(Request $request)
    {
        $input = $request->uuid_name ;
        $user = resolve(userRepo::class)->getIdName($input);
        if(is_null($user)) {
           $save =  resolve(userRepo::class)->create($request);
           $save->t_balance()->create(['amount'=>0]);

           dd($save);
        }
//        $user->with
        dd('dsadsadsa');
    }
}
