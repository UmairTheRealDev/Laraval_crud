<?php

use App\Http\Controllers\EmployeeController;
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

// Route::get('/', function () {
//     return view('admin.main');
// });

Route::get("/",[EmployeeController::class, "index"])->name("main.form");
Route::post("/",[EmployeeController::class,"store"]);
Route::get("/table",[EmployeeController::class,"show"])->name("main.table");
Route::get("/delete/{id}",[EmployeeController::class,"destroy"])->name("emp.delete");
Route::get("/edit/{id}",[EmployeeController::class,"edit"])->name("emp.edit");
Route::post("/update/{id}",[EmployeeController::class,"update"])->name("emp.update");


// Route::get('/about', function () {
//     return view('admin\about');
// });

// Route::get('/contact', function () {
//     return view('admin\contact');
// });