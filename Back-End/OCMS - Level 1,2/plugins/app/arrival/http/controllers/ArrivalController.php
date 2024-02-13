<?php namespace App\Arrival\Http\Controllers;

use Backend\Classes\Controller;
use Illuminate\Http\Request;

use App\Arrival\Models\Arrival;
use App\Arrival\Http\Resources\ArrivalResource;

class ArrivalController extends Controller {
    public function index() {
        $arrivals = Arrival::all();
        return ArrivalResource::collection($arrivals);
    }

    public function show($user_id) {
        $arrival = Arrival::where('user_id', $user_id)->first();
        return new ArrivalResource($arrival);
    }

    public function store(Request $request) {
        $arrival = new Arrival();
        $arrival->fill($request->all());
        $arrival->user_id = auth()->user()->id;
        $arrival->save();
        return response()->json($arrival, 201);
    }
}
