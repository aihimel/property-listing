<?php

use App\Http\Controllers\API\PropertyGroupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PropertyController;

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

Route::get(
    'properties',
    [PropertyController::class, 'index']
)->name('api.properties.index');

Route::post(
    'properties',
    [PropertyController::class, 'store']
)->name('api.properties.store');

Route::put(
    'properties/{property}',
    [PropertyController::class, 'update']
)->name('api.properties.update');

Route::delete(
    'properties',
    [PropertyController::class, 'delete']
)->name('api.properties.delete');


// Property Group
Route::get(
    'property-groups',
    [PropertyGroupController::class, 'index']
)->name('api.property_groups.index');

Route::post(
    'property-groups',
    [PropertyGroupController::class, 'store']
)->name('api.property_groups.store');

Route::put(
    'property-groups/{property_group}',
    [PropertyGroupController::class, 'update']
)->name('api.property_groups.update');

Route::delete(
    'property-groups/{property_group}',
    [PropertyGroupController::class, 'delete']
)->name('api.property_groups.delete');
