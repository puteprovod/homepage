<?php

use App\Http\Controllers\Account\UpdateOneController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;

    Route::post('/resizer', App\Http\Controllers\Resizer\StoreController::class);
    Route::get('/resizer', App\Http\Controllers\Resizer\ResultController::class);
Route::get('/resizer/progress/{token}', App\Http\Controllers\Resizer\ProgressController::class);

//Route::group(['middleware' => 'jwt.auth'], function () {
//    Route::get('/get',App\Http\Controllers\GetController::class);
//});
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::controller(TodoController::class)->group(function () {
    Route::get('todos', 'index');
    Route::post('todo', 'store');
    Route::get('todo/{id}', 'show');
    Route::put('todo/{id}', 'update');
    Route::delete('todo/{id}', 'destroy');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['namespace'=>'App\Http\Controllers\Post','middleware'=>'jwt.auth'], function () {
    Route::get('/posts', 'IndexController');
    Route::get('/posts/create', 'CreateController');
    Route::patch('/posts/{post}', 'UpdateController');
    Route::delete('/posts/{post}', 'DestroyController');
    Route::get('/posts/{post}', 'ShowController');
    Route::get('/posts/{post}/edit', 'EditController');
    Route::post('/posts/', 'StoreController');
});


