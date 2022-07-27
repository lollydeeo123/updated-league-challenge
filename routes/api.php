<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MatrixController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|[CsvfileController::class,'upload']
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::apiResource('/matrix', MatrixController::class)->only([
//     'index'
// ]);
 Route::post('/matrix', function (Request $request) {
    return $request->file();
});

Route::get('/', function () {
    return view('welcome');
});
Route::post('/upload', [MatrixController::class, 'index'])->name('upload');
Route::post('/echo', [MatrixController::class, 'echo'])->name('echo');
Route::post('/multiply', [MatrixController::class, 'multiply'])->name('multiply');
Route::post('/sum', [MatrixController::class, 'sum'])->name('sum');
Route::post('/flatten', [MatrixController::class, 'flatten'])->name('flatten');
Route::post('/invert', [MatrixController::class, 'invert'])->name('invert');