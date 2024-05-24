<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repository\userRepo;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function __construct(public userRepo $userRepo){}

    public function index(Request $request)
    {
        if($request->header('info-user')){
            $user = $this->userRepo->getIdName($request->header('info-user'));

        }
    }
}
