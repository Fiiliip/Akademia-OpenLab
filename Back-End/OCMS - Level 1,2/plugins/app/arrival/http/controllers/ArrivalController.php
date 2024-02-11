<?php namespace App\Arrival\Http\Controllers;

use Backend\Classes\Controller;
use Illuminate\Http\Request;

use App\Arrival\Models\Arrival;

class ArrivalController extends Controller {
    public function getArrivals() {
        $arrivals = Arrival::all();
        return response()->json($arrivals, 200);
    }

    public function getArrival($id) {
        $arrival = Arrival::where('id', $id)->first();
        return response()->json($arrival, 200);
    }

    public function createArrival(Request $request) {
        $arrival = new Arrival();
        $arrival->fill($request->all());
        $arrival->save();
        return response()->json($arrival, 201);
    }
}
