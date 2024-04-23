<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name("home");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::resource('/car', CarController::class);
    Route::get('/generate-pdf', [OrderController::class, 'getReportData'])->name('getReportData');
});
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::post('/order/store/{id}', [OrderController::class, 'store'])->name('buyCar');
    Route::get('/most', [OrderController::class, 'getReportData']);
    Route::get('/home', [HomeController::class, 'index'])->name('homePage');
    Route::view('/buying-notification', 'pages.buyingNotification')->name('buyingNotification');
});

require __DIR__ . '/auth.php';
