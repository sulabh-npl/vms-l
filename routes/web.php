<?php

use App\Http\Controllers\adminController;
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

Route::get('delete_visitor/{id}', [vendorController::class, "visitor_delete"]);
Route::post('update/visitor', [vendorController::class, "visitor_edit"]);
Route::get('visitors/{id}', [vendorController::class, "visitor"]);

Route::get('/new_user', [vendorController::class, "new_user"]);
Route::post("/post_new_user", [vendorController::class, "post_new_user"]);
Route::view('/change_pass', 'change_pass');
Route::post("/change_pass", [vendorController::class, "change_pass"]);

Route::get('/manage_users', [vendorController::class, "manage_users"]);
Route::get('users/{id}', [vendorController::class, "staff"]);
Route::get('delete_users/{id}', [vendorController::class, "staff_delete"]);
Route::post('update/staff', [vendorController::class, 'staff_update']);

Route::get('section', [vendorController::class, "section"]);
Route::prefix("/admin")->group(function () {
    Route::get('/', [adminController::class, 'index']);
    Route::get('/list', [adminController::class, 'list']);
    Route::get('/login/{id}', [adminController::class, 'vendor_login']);
    Route::get('/login', [adminController::class, "login"]);
    Route::post('/logged', [adminController::class, "logged"]);
    Route::post('/otp', [adminController::class, 'otp']);
});
