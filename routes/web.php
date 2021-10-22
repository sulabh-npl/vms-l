<?php

use App\Http\Controllers\vendorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [vendorController::class, "index"]);
Route::get('/login', [vendorController::class, "login"]);
Route::post("/logged", [vendorController::class, "logged"]);
Route::get('/logout', [vendorController::class, "logout"]);
Route::post("/otp", [vendorController::class, "otp"]);
