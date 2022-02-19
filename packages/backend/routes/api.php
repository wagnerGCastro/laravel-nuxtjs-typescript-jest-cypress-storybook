<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Api\AuthController;

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

Route::get('/v1/test', function (Request $request) {
    $users = User::get();

        return response()->json([
            'codeStatus' => '200',
            'totUsers' => $users
        ], 200);
});

Route::post('/auth/login', [AuthController::class, 'authenticate'])->name('auth.login');
Route::post('/auth/register', [AuthController::class, 'register'])->name('auth.register');

Route::group(['middleware' => ['jwt.verify']], function() {

    /** AUTH */
    Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/auth/me', [AuthController::class, 'me'])->name('auth.me');

    /** API VERSION 1 */
    Route::prefix('v1')->group(function() {
        /** User */
        // Route::get('/users', [UserController::class, 'index'])->name('user.index');
        // Route::get('/users/{user_id}', 'Api\UserController@show')->name('user.show');
        // Route::put('/users/{user_id}', 'Api\UserController@update')->name('user.update');
        // Route::delete('/users/{user_id}', 'Api\UserController@destroy')->name('user.destroy');
    });
});