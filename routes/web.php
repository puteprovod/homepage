<?php

use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::controller(App\Http\Controllers\Auth\LoginController::class)->group(function (){
    Route::get('google_auth/redirect', 'redirectGoogle')->name('authorize.google');
    Route::get('google_auth/callback', 'callbackGoogle');
    Route::get('gitlab_auth/redirect', 'redirectGitlab')->name('authorize.gitlab');
    Route::get('gitlab_auth/callback', 'callbackGitlab');
});

Route::get('/', 'App\Http\Controllers\Summary\IndexController')
    ->name('summary.index')->middleware('index'); //MAIN PAGE

Route::get('/main', 'App\Http\Controllers\MainController')
    ->name('main.index'); //MAIN PAGE FOR GUESTS
Route::get('/lang/{newLang}', 'App\Http\Controllers\MainController');
Route::get('/octopawn', 'App\Http\Controllers\Octopawn\IndexController')
    ->name('octopawn.index');
Route::post('/octopawn', 'App\Http\Controllers\Octopawn\IndexController');
Route::get('/accounts', 'App\Http\Controllers\Account\IndexController')
    ->name('accounts.index');
Route::get('/currencies', 'App\Http\Controllers\Currency\IndexController')
    ->name('currencies.index');
Route::get('/about', 'App\Http\Controllers\AboutController@index')
    ->name('about');
Route::get('/test',\App\Http\Controllers\TestController::class)
    ->middleware('admin');

Route::group(['prefix'=>'resizer','namespace'=>'App\Http\Controllers\Resizer'],function(){
    Route::get('/', 'IndexController')
        ->name('resizer.index');
    Route::get('/{token}', 'ResultController')
        ->name('resizer.result');
    Route::get('/zip/{token}','ZipController')
        ->name('resizer.zip');
});

Route::group(['middleware'=>'admin','namespace'=>'App\Http\Controllers\Admin\Currency','prefix'=>'admin/currencies'],function () {
    Route::get('/', 'IndexController')
        ->name('admin.currencies.index');
    Route::get('create', 'CreateController')
        ->name('admin.currencies.create');
    Route::patch('/{currency}', 'UpdateController')
        ->name('admin.currencies.update');
    Route::delete('/{currency}', 'DestroyController')
        ->name('admin.currencies.destroy');
    Route::get('/{currency}', 'ShowController')
        ->name('admin.currencies.show');
    Route::get('/{currency}/edit', 'EditController')
        ->name('admin.currencies.edit');
    Route::post('/', 'StoreController')
        ->name('admin.currencies.store');
});

Route::group(['middleware'=>'admin','namespace'=>'App\Http\Controllers\Admin\Account','prefix'=>'admin/accounts'],function () {
    Route::get('/', 'IndexController')
        ->name('admin.accounts.index');
    Route::delete('/history/{dateTime}', 'History\DestroyController')
        ->name('admin.accounts.history.destroy');
    Route::get('/history', 'History\IndexController')
        ->name('admin.accounts.history.index');
    Route::get('create', 'CreateController')
        ->name('admin.accounts.create');
    Route::patch('/{account}', 'UpdateController')
        ->name('admin.accounts.update');
    Route::delete('/{account}', 'DestroyController')
        ->name('admin.accounts.destroy');
    Route::get('/{account}', 'ShowController')
        ->name('admin.accounts.show');
    Route::get('/{account}/edit', 'EditController')
        ->name('admin.accounts.edit');
    Route::post('/', 'StoreController')
        ->name('admin.accounts.store');
});

//Auth::routes();
