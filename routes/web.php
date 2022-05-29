<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\AdminController;

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
Route::get('lang/{locale?}', function ($locale = null) {
    if (in_array($locale, ['en', 'id'])) {
        Session::put('locale', $locale);
    }

    return back();
});

Route::middleware(['locales'])->group(function () {

    // template
    Route::get('/admin-lite/{view?}', function($view = 'dashboard'){
        return view('admin-lite/'.$view);
    })->name('admin-lite');


    // guest
    Route::get('/', function () {
        return Auth::user();
        return "Halaman utama";
    });


    // admin
    Route::prefix('admin')->group(function () {
        Route::get('/', function () {
            return redirect()->route('login');
        });

        Route::middleware(['auth'])->group(function () {
            Route::get('/admin-page/{view?}', function($view = 'dashboard'){
                return view('admin/'.$view);
            })->name('admin-page');

            Route::get('/dashboard', [AdminController::class,'index'])->name('dashboard');
            Route::get('/log', [AdminController::class,'log'])->name('log');

            Route::resource("/category", App\Http\Controllers\Admin\CategoriesController::class);
            Route::resource("/news", App\Http\Controllers\Admin\NewsController::class);
        });

        require __DIR__.'/auth.php';
    });

});

