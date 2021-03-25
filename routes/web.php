<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', [UserController::class, 'login']);

Route::post('/employee', [EmployeeController::class, 'getEmployee']);

Route::post('/addemployee', [EmployeeController::class, 'addEmployee']);

Route::delete('/deleteemployee/{id}', [EmployeeController::class, 'deleteEmployee']);

Route::patch('/updateemployee/{id}', [EmployeeController::class, 'updateEmployee']);

Route::get('/getoneemployee/{id}', [EmployeeController::class, 'getOneEmployee'])->middleware('verifyuser');

Route::get('/country', [CountryController::class, 'getCountry']);

Route::post('/state', [StateController::class, 'getState']);

Route::post('/city', [CityController::class, 'getCity']);

Route::post('/user', [UserController::class, 'register']);


