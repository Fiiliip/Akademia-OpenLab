<?php namespace App\Arrival\Http\Controllers;

use Backend\Classes\Controller;
use Illuminate\Http\Request;

use App\Arrival\Models\Arrival;
use App\Arrival\Http\Resources\ArrivalResource;

use Event;

class ArrivalController extends Controller {
    public function index() {
        $arrivals = Arrival::all();
        return ArrivalResource::collection($arrivals);
    }

    public function show() {
        $user_id = auth()->user()->id;
        // Get all arrivals for the user
        $arrivals = Arrival::where('user_id', $user_id)->get();
        Event::fire('app.arrival.show', [$user_id]);
        return ArrivalResource::collection($arrivals);
    }

    public function store(Request $request) {
        $arrival = new Arrival();
        $arrival->fill($request->all());
        if (auth()->user()) {
            $arrival->user_id = auth()->user()->id;
        }
        $arrival->save();
        return new ArrivalResource($arrival);
    }
}
