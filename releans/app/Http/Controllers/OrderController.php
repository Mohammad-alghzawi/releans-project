<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $order = new Order;
        $order->car_id = $id;
        $order->user_id = Auth::user()->id;
        $order->save();

        $car = Car::find($id);
        $car->stock--;
        $car->save();

        return redirect()->route('buyingNotification');
    }

    public function getReportData(){
        $numberOfOrders = Order::count();
        $numberOfTotalCars = Car::count();
        $numberOfCarsInStock = Car::where('stock', '>=', 1)->count();
        $mostRepeatedCarId = Order::select('car_id')
        ->groupBy('car_id')
        ->orderByRaw('COUNT(*) DESC')
        ->limit(1)
        ->pluck('car_id')
        ->first();

   
    $mostPopularCar = Car::find($mostRepeatedCarId);

    $data = [
        'numberOfOrders' => $numberOfOrders,
        'numberOfTotalCars' => $numberOfTotalCars,
        'numberOfCarsInStock' => $numberOfCarsInStock,
        'mostPopularCar' => $mostPopularCar->type,
    ];

    
    return response()->json($data);
}
  
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
