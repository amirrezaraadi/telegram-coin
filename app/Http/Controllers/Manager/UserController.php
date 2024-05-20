<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repository\userRepo;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(public userRepo $userRepo)
    {
    }

    public function index()
    {
        return $this->userRepo->index();
    }

    public function store(Request $request)
    {
        $this->userRepo->create($request->only(
            'uuid_name',
            'id_tele',
            'phone',
        ));

        return response()->json(['message ' => 'success create user', 'status' => 'success'], 200);
    }

    public function show($user)
    {
        return $this->userRepo->getFindId($user);
    }

    public function update(Request $request, User $user)
    {
        //
    }


    public function destroy(User $user)
    {
        //
    }

    public function add_wallet(Request $request , $id)
    {
        $user = $this->userRepo->getFindId($id);
        $this->userRepo->add_wallet($request->only('wallet') , $user->id);
        return response()->json(['message' => 'change add wallet ', 'status' => 'success'], 200);
    }

    public function users_state_chart()
    {
        $users =  $this->userRepo->users_state();
        return response(['users' =>$users]);
    }
}
