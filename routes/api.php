<?php

use App\Http\Controllers\API\CalculateDistanceController;
use App\Http\Controllers\API\ChangeDirectoryController;
use App\Http\Controllers\API\ConvertBinariesController;
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

Route::get('cd', [ChangeDirectoryController::class, 'index']);
Route::get('binary', [ConvertBinariesController::class, 'index']);
Route::get('distance', [CalculateDistanceController::class, 'index']);
