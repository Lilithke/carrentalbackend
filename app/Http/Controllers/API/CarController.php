<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Http\Requests\StoreCarRequest;
use App\Models\Rental;

use function PHPUnit\Framework\isEmpty;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::all();
        return response()->json(["data"=>$cars]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarRequest $request)
    {
        $cars = new Car ($request -> all());
        $cars -> save();
        return response()->json($cars,201);
    }

    public function rent(Request $request, string $id)
    {
        $cars = Car::find($id);
        if (is_null($cars)) {
            return response()->json(["message" => "Car not found with id: $id"], 404);
        }
        $rentals = Rental::where([
            ["car_id", $id],
            ["start_date","<=", date("Y-m-d")],
            ["end_date",">", date("Y-m-d")],
        ]) -> get();

        if (!$rentals -> isEmpty()) {
            return response()->json(["message" => "Car is currently rented"], 409);
        }

        $rental = new Rental();
        $rental -> car_id = $id;
        $rental -> start_date = date("Y-m-d");
        $rental -> end_date = date("Y-m-d", strtotime("+1 week"));
        $rental -> save();
        return response()->json($rental, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
