<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\appController;
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
Route::get('/chart-data', [vendorController::class, "index_chart"]);
Route::get('/attendence', [vendorController::class, "attendence"]);
Route::post("/update_details", [vendorController::class, "update_self"]);

Route::get('/about', [vendorController::class, "about"]);
Route::view('/register', 'register');
Route::post('/register', [vendorController::class, "register"]);

Route::get('/login', [vendorController::class, "login"]);
Route::post("/logged", [vendorController::class, "logged"]);
Route::get('/logout', [vendorController::class, "logout"]);
Route::get('/otp', [vendorController::class, 'otp_get']);
Route::post("/otp", [vendorController::class, "otp"]);

Route::post("/addSection", [vendorController::class, "add_section_post"]);
Route::post("/rename", [vendorController::class, "section_rename"]);
Route::get('/addSection', [vendorController::class, "add_section"]);
Route::post('/delete_sec/{name}', [vendorController::class, "section_del"]);

Route::post('delete_visitor/{id}', [vendorController::class, "visitor_delete"]);
Route::post('update/visitor', [vendorController::class, "visitor_edit"]);
Route::get('visitors/{id}', [vendorController::class, "visitor"]);

Route::get('/new_user', [vendorController::class, "new_user"]);
Route::get('/user', [vendorController::class, "user"]);
Route::post("/post_new_user", [vendorController::class, "post_new_user"]);
Route::view('/change_pass', 'change_pass');
Route::post("/change_pass", [vendorController::class, "change_pass"]);

Route::get('/manage_users', [vendorController::class, "manage_users"]);
Route::get('users/{id}', [vendorController::class, "staff"]);
Route::post('delete_user/{id}', [vendorController::class, "staff_delete"]);
Route::post('update/staff', [vendorController::class, 'staff_update']);
Route::post('reset/staff', [vendorController::class, 'staff_reset']);

Route::get('section', [vendorController::class, "section"]);
Route::get('details', [vendorController::class, "view_self"]);

Route::prefix("/admin")->group(function () {
    Route::get('/', [adminController::class, 'index']);

    Route::get('/about', [adminController::class, 'about']);
    Route::post('/about', [adminController::class, 'about_post']);

    Route::get('/addVendor', [adminController::class, 'add_vendor']);
    Route::post('/addVendor', [adminController::class, 'add_vendor_post']);
    Route::get('vendors/{id}', [adminController::class, "vendors"]);
    Route::post('delete_vendor/{id}', [adminController::class, "vendor_delete"]);
    Route::post('update_vendor', [adminController::class, 'vendor_update']);

    Route::get('vendor_reqs/{id}', [adminController::class, "vendor_reqs"]);
    Route::get('/vendor_requests', [adminController::class, 'requested_vendors']);
    Route::post('delete_vendor_req/{id}', [adminController::class, "vendor_req_delete"]);

    Route::get("/new_user", [adminController::class, "new_user"]);
    Route::post("/post_new_user", [adminController::class, "post_new_user"]);

    Route::get('/manage_users', [adminController::class, "manage_users"]);
    Route::get('users/{id}', [adminController::class, "staff"]);
    Route::post('delete_user/{id}', [adminController::class, "staff_delete"]);
    Route::post('update/staff', [adminController::class, 'staff_update']);
    Route::post('reset/staff', [adminController::class, 'staff_reset']);

    Route::get('/user', [adminController::class, "user"]);
    Route::view('/change_pass', 'admin.change_pass');
    Route::post("/change_pass", [adminController::class, "change_pass"]);

    Route::get('/list', [adminController::class, 'list']);

    Route::get('/login/{id}', [adminController::class, 'vendor_login']);

    Route::get('/login', [adminController::class, "login"]);
    Route::get('/logout', [adminController::class, "logout"]);
    Route::post('/logged', [adminController::class, "logged"]);
    Route::post('/otp', [adminController::class, 'otp']);
    Route::get('/otp', [adminController::class, 'otp_get']);
});
Route::prefix("/app")->group(function () {
    Route::get('login/{c}/{d}/{e}', [appController::class, 'login']);
});
