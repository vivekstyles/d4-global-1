<?php

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

Route::get('/', function () {
    return view('auth.employee');
});

try {
    //code...
    Route::get('/', 'AuthController@index');
    Route::post('/validate', 'AuthController@loginValidation');
    Route::get('/ajax', 'AuthController@ajax');
} catch (\Throwable $th) {
    Route::get('/', 'AuthController@index');
}
