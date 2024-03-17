<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Маршрут создает тестовых пользователей со случайными данными
 */
Route::middleware('web')->get('/tests/createUser', function (Request $request) {
    $newUser = \App\Models\User::factory()->makeOne();
    $newUser->save();

//    $roles = $user->roles()->pluck('original_id');
//    $t = $user->getOwner()->inheritance()->dd();
//    $t = $user->getOwner()->inheritance()->get()->toArray();
});
