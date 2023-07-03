<?php

use App\Http\Controllers\CsvUploadController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('location');
});

// dd(request()->file('csv')->get());
Route::get('upload', [CsvUploadController::class, 'index'])->name('upload');
Route::post('upload', [CsvUploadController::class, 'store'])->name('upload.csv');
// Route::post('/upload', function (){
//     dd(request()->all());
// })->name('upload.csv');

Route::get('/clear-cache', function () {

    Artisan::call('optimize');
    Artisan::call('optimize:clear');
    Artisan::call('config:cache');
    Artisan::call('route:clear');
    Artisan::call('view:cache');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    return "Cache cleared successfully";
 });
