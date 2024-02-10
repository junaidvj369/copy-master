<?php

use App\Http\Controllers\Admin\EnquiryController as AdminEnquiryController;
use App\Http\Controllers\Admin\ServiceTypeController;
use App\Http\Controllers\User\EnquiryController;
use App\Http\Controllers\User\PageController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('about', [PageController::class, 'about'])->name('about');
Route::get('services', [PageController::class, 'services'])->name('services');
Route::get('contact', [PageController::class, 'contact'])->name('contact');
Route::prefix('enquiry/')->name('enquiry.')->group(function () {
    Route::post('/', [EnquiryController::class, 'store'])->name('store');
});


Route::get('admin/login', function () {
    return view('auth.login');
});

Auth::routes();

Route::prefix('admin/')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::prefix('enquiry/')->name('enquiry.')->group(function () {
        Route::get('/', [AdminEnquiryController::class, 'index'])->name('index');
        Route::post('datatable', [AdminEnquiryController::class, 'datatable'])->name('datatable');
    });

    Route::prefix('service/')->name('service.')->group(function () {
        Route::post('/', [ServiceTypeController::class, 'store'])->name('store');
        Route::get('/', [ServiceTypeController::class, 'index'])->name('index');
        Route::get('create', [ServiceTypeController::class, 'create'])->name('create');
        Route::patch('{service}', [ServiceTypeController::class, 'update'])->name('update');
        Route::get('{service}/edit', [ServiceTypeController::class, 'edit'])->name('edit');
        Route::post('datatable', [ServiceTypeController::class, 'datatable'])->name('datatable');
    });
});
