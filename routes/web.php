<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtikelControllers;
use App\Http\Controllers\CKEditorControllers;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [ArtikelControllers::class, 'list']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('daftar-artikel', ArtikelControllers::class);
Route::post('ckeditor/image_upload', [CKEditorControllers::class, 'upload'])->name('upload');
