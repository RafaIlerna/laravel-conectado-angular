<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudenController;
use App\Http\Controllers\TeacherController;
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

Route::post('registert', [TeacherController::class, 'registert']);
Route::post("registers", [StudenController::class, "registers"]);

Route::post('logint', [TeacherController::class, 'logint']);
Route::post('logins', [TeacherController::class, 'logins']);

/*Route::post('/login',"login")->name('logins');
Route::post('/principal','principal')->middleware('auth')->name('principal');*/

Route::group(['middleware' => ["auth:sanctum"]], function () {
    Route::get('showteacher', [TeacherController::class, 'showteacher']);
    Route::get('showstuden', [StudenController::class, 'showstuden']);

    Route::get('logoutt', [TeacherController::class, 'logoutt']);
    Route::get('logouts', [StudenController::class, 'logouts']);
});

Route::post("createrole", [RoleController::class, "createrole"]);
Route::delete("destroyrole", [RoleController::class, "destroyrole"]);
Route::get("showrole", [RoleController::class, "showrole"]);

Route::delete("destroystuden", [StudenController::class, "destroystuden"]);
Route::get("showstuden", [StudenController::class, "showstuden"]);

Route::delete("destroyteacher", [TeacherController::class, "destroyteacher"]);
Route::get("showteacher", [TeacherController::class, "showteacher"]);
