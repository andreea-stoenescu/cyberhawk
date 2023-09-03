<?php

use App\Http\Controllers\TurbineController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//could use resource for this/could group by controller
Route::get('turbines/{turbine}', [TurbineController::class, 'show']);
Route::get('/turbines', [TurbineController::class, 'index']);
Route::post('/turbines', [TurbineController::class, 'store']);
Route::patch('turbines/{turbine}', [TurbineController::class, 'update']);
Route::delete('turbines/{turbine}', [TurbineController::class, 'destroy']);

Route::post('turbines/{turbine}/components', [TurbineController::class, 'addComponents']);
