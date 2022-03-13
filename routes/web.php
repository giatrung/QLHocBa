<?php
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
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

//Hoc sinh controller
Route::get('/filters', [App\Http\Controllers\HocSinhController::class, 'index'])->name('index');

Route::get('/danhsachhocsinh', [App\Http\Controllers\HocSinhController::class, 'filters'])->name('filters');
Route::get('/filtersGV', [App\Http\Controllers\GiaovienController::class, 'filterGV'])->name('filterGV');
Route::post('/danhsachgiaovien', [App\Http\Controllers\GiaovienController::class, 'getListGV'])->name('dsgv');


Route::get('/import', [App\Http\Controllers\HocSinhController::class, 'showImport'])->name('showImport');
Route::post('/import', [App\Http\Controllers\HocSinhImPortController::class, 'store'])->name('store');
Route::post('/importGV', [App\Http\Controllers\GiaovienImportController::class, 'storeGV'])->name('storeGV');

Route::get('/danhsachhocsinh/xoa/{id}', [App\Http\Controllers\HocSinhController::class, 'xoa'])->name('xoa');
Route::get('/danhsachhocsinh/show/{id}', [App\Http\Controllers\HocSinhController::class, 'show'])->name('show');

Route::put('/giaovien/update',[App\Http\Controllers\GiaovienController::class, 'update'])->name('update');
Route::get('/giaovien/delete/{id}',[App\Http\Controllers\GiaovienController::class, 'delete'])->name('delete');
Route::get('/giaovien/phanlop',[App\Http\Controllers\GiaovienController::class, 'phanlop'])->name('phanlop');
Route::post('/giaovien/phanlop',[App\Http\Controllers\GiaovienController::class, 'storeLop'])->name('storeLop');
Route::get('/giaovien/chamdiem/{hocsinh}',[App\Http\Controllers\DiemController::class, 'chamdiem'])->name('chamdiem');
Route::post('/giaovien/chamdiem',[App\Http\Controllers\DiemController::class, 'chamdiemact'])->name('chamdiemact');
Route::post('/giaovien/timkiem',[App\Http\Controllers\GiaovienController::class, 'search'])->name('search');

Route::post('/taolop',[App\Http\Controllers\LopController::class,'create'])->name('createLop');
