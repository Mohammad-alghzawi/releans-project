<?php

namespace App\Http\Controllers;

use App\Models\car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = car::all();
        return view('pages.index', compact('cars'));
        // return response()->json($cars);
    }

    public function getCars()
    {
        $cars = car::all();
        // return view('pages.index', compact('cars'));
        return response()->json($cars);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|string',
            'model_year' => 'required|integer|min:1900|max:' . date('Y')+1, 
            'color' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
            'stock' => 'required|integer',
            'discount' => 'required|integer|min:0|max:100|',
            'price' => 'required|integer',
            
            
        ]);

        $car = new Car;
        $car->type = $validatedData['type'];
        $car->model_year = $validatedData['model_year'];
        $car->color = $validatedData['color'];
        $car->stock = $validatedData['stock'];
        $car->discount = $validatedData['discount'];
        $car->price = $validatedData['price'];


        $priceAfterDiscount = $car->price - ($car->price * $car->discount / 100);
        $car->price_after_discount = $priceAfterDiscount;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $car->image = $imageName;

        }
      
        try {
            $car->save();
            return redirect('car')->with('status', 'Car Added successfully!');
    
        } catch (\Throwable $th) {
            return redirect('car')->with('status', 'error while adding the car!');
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\car  $car
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carShow = car::find($id);
        return view('pages.show', compact("carShow"));
        // return response()->json($carShow);
    }
    public function getCar($id)
    {
        $car = car::find($id);
        // return view('pages.show', compact("carShow"));
        return response()->json($car);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = car::find($id);
        return view('pages.edit', compact("car"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'type' => 'required|string',
            'model' => 'required|integer|min:1900|max:' . (date('Y') + 1), 
            'color' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
            'stock' => 'required|integer',
            'discount' => 'required|integer|min:0|max:100',
            'price' => 'required|integer',
        ]);
    
        $car = Car::find($id);
    
        $car->type = $validatedData['type'];
        $car->model_year = $validatedData['model'];
        $car->price = $validatedData['price'];
        $car->color = $validatedData['color'];
        $car->stock = $validatedData['stock'];
        $car->discount = $validatedData['discount'];
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $car->image = $imageName;
        }
    
        $priceAfterDiscount = $car->price - ($car->price * $car->discount / 100);
        $car->price_after_discount = $priceAfterDiscount;
    
        $car->save();
    
        return redirect()->route('car.index')->with('status', 'Car Updated!');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        car::destroy($id);
        return redirect('car')->with('status', 'Car Deleted successfully!');

    }
}