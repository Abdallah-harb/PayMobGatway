<?php

use App\Http\Controllers\Paymob\CerditController;
use App\Http\Controllers\Paymob\ChouckoutController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//payment Pay_mob


Route::group(['prefix' => "Payment"],function(){

    //1-create checkout
    Route::post('checkout',[ChouckoutController::class,'index'])->name('checkout');

    //2- [put this in the api route] transaction process callback put in api because wep has csrf token
    Route::post('checkout/process',[ChouckoutController::class,'update']);

    //3- redirect route after finished payment
    Route::get('checkout/response',[ChouckoutController::class,'backView']);

});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
