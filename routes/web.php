<?php

use App\Http\Controllers\Account\UpdateOneController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::patch('/accounts/{post}',UpdateOneController::class)->name('account.update');


Route::get('/dashboard', function () {
    return Inertia::render('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/game', 'App\Http\Controllers\Octopawn\TestController');


require __DIR__.'/auth.php';
Route::get('/', 'App\Http\Controllers\Currency\IndexController');
Route::get('/logout', 'App\Http\Controllers\Auth\LogoutController')->name('logout');
Route::group(['middleware'=>'admin','namespace'=>'App\Http\Controllers\Admin\Post','prefix'=>'admin/post'],function () {
    Route::get('/', 'IndexController')->name('admin.post.index');
});
Route::group(['middleware'=>'admin','namespace'=>'App\Http\Controllers\Admin\Currency','prefix'=>'admin/currencies'],function () {
    Route::get('/', 'IndexController')->name('admin.currencies.index');
    Route::get('create', 'CreateController')->name('admin.currencies.create');
    Route::patch('/{currency}', 'UpdateController')->name('admin.currencies.update');
    Route::delete('/{currency}', 'DestroyController')->name('admin.currencies.destroy');
    Route::get('/{currency}', 'ShowController')->name('admin.currencies.show');
    Route::get('/{currency}/edit', 'EditController')->name('admin.currencies.edit');
    Route::post('/', 'StoreController')->name('admin.currencies.store');
});
Route::group(['middleware'=>'admin','namespace'=>'App\Http\Controllers\Admin\Account','prefix'=>'admin/accounts'],function () {
    Route::get('/', 'IndexController')->name('admin.accounts.index');
    Route::get('create', 'CreateController')->name('admin.accounts.create');
    Route::patch('/{account}', 'UpdateController')->name('admin.accounts.update');
    Route::delete('/{account}', 'DestroyController')->name('admin.accounts.destroy');
    Route::get('/{account}', 'ShowController')->name('admin.accounts.show');
    Route::get('/{account}/edit', 'EditController')->name('admin.accounts.edit');
    Route::post('/', 'StoreController')->name('admin.accounts.store');
});
//Route::group(['middleware'=>'admin'],function() {
//    Route::get('/accounts', 'App\Http\Controllers\Account\IndexController')->name('accounts.index');
//    Route::patch('/accounts', 'App\Http\Controllers\Account\UpdateController')->name('accounts.update');
//});

Route::get('/octopawn', 'App\Http\Controllers\Octopawn\IndexController')->name('octopawn.index');
Route::get('/resizer', 'App\Http\Controllers\Resizer\IndexController')->name('resizer.index');
Route::get('/resizer/{token}', App\Http\Controllers\Resizer\ResultController::class);
Route::get('/resizer/zip/{token}','App\Http\Controllers\Resizer\ZipController')->name('resizer.zip');
Route::get('/resizer/zip','App\Http\Controllers\Resizer\ZipController');
Route::get('/test','App\Http\Controllers\Resizer\TestController');
Route::get('/accounts', 'App\Http\Controllers\Account\IndexController')->name('accounts.index');
Route::get('/currencies', 'App\Http\Controllers\Currency\IndexController')->name('currencies.index');
Route::get('/about', 'App\Http\Controllers\AboutController@index')->name('about');


//Auth::routes();
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
