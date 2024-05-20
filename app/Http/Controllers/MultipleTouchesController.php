<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMultipleTouchesRequest;
use App\Http\Requests\UpdateMultipleTouchesRequest;
use App\Models\Manager\MultipleTouches;
use App\Repository\multiple_touchesRepo;

class MultipleTouchesController extends Controller
{
    public function __construct(public multiple_touchesRepo $multiple_touchesRepo)
    {
    }

    public function index()
    {
        return $this->multiple_touchesRepo->index();
    }


    public function store(StoreMultipleTouchesRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->multiple_touchesRepo->create($request->only([
            'title',
            'unit',
            'amount',
        ]));
        return response()->json(['message' => 'success create multi', 'status' => 'success'], 200);
    }


    public function show($multipleTouches)
    {
        return $this->multiple_touchesRepo->getFindId($multipleTouches);
    }


    public function update(UpdateMultipleTouchesRequest $request, $multipleTouches)
    {
        $id = $this->multiple_touchesRepo->getFindId($multipleTouches);
        $this->multiple_touchesRepo->update($request->only([
            'title',
            'unit',
            'amount',
        ]), $id );
        return response()->json(['message' => 'success update multi', 'status' => 'success'], 200);
    }


    public function destroy($multipleTouches)
    {
        $id = $this->multiple_touchesRepo->getFindId($multipleTouches);
        $this->multiple_touchesRepo->delete($id->id);
        return response()->json(['message' => 'success delete multi', 'status' => 'success'], 200);

    }
}
