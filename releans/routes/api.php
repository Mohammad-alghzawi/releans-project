<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\OrderController;
use App\Models\Car;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('getReport', [OrderController::class, 'getReportData']);
Route::prefix('cars')->group(function () {
    // Retrieve a list of cars
    Route::get('/', function () {
        return Car::all();
    });

    // Retrieve a single car by ID
    Route::get('/{id}', function ($id) {
        return Car::findOrFail($id);
    });

    // Create a new car
    Route::post('/', function (Request $request) {
        return Car::create($request->all());
    });

    // Update an existing car
    Route::put('/{id}', function (Request $request, $id) {
        $car = Car::findOrFail($id);
        $car->update($request->all());
        return $car;
    });

    // Delete a car
    Route::delete('/{id}', function ($id) {
        $car = Car::findOrFail($id);
        $car->delete();
        return response()->noContent();
    });
});
