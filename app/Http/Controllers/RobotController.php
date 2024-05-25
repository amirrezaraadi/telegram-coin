<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRobotRequest;
use App\Http\Requests\UpdateRobotRequest;
use App\Models\Robot;
use App\Repository\robotRepo;

class RobotController extends Controller
{
    public function __construct(public robotRepo $robotRepo)
    {
    }

    public function index()
    {
        return $this->robotRepo->idnex();
    }


    public function store(StoreRobotRequest $request)
    {
        $this->robotRepo->create($request);
        return response()->json(['ok'], 200);
    }

    public function show($robot)
    {
        return $this->robotRepo->getFindId($robot);
    }

    public function update(UpdateRobotRequest $request, $robot)
    {
        $this->robotRepo->update($request, $robot);
        return response()->json(['ok'], 200);

    }

    public function destroy($robot)
    {
        $this->robotRepo->delete($robot);
        return response()->json(['ok'], 200);

    }
}
