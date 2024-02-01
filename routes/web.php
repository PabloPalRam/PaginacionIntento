<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SettingController;

use App\Http\Controllers\PaginateArtistController;
use App\Http\Controllers\DiskController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\PaisController;
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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/',function(){
   return view('app.base'); 
});

Route::resource('movie',MovieController::class);
Route::resource('artist', ArtistController::class);
Route::resource('disk', DiskController::class);
Route::get('disk/create/{idartist}',[DiskController::class, 'disk.createArtist'])->name('disk.create.artist');
Route::get('disk/view/file/fotosubida.jpg',[DiskController::class,'view'])->name('disk.view');


Route::get('movie/view/{ide}', [MovieController::class, 'view'])-> name('movie.view');

Route::get('setting', [SettingController::class, 'index'])-> name('setting.index');
Route::put('setting', [SettingController::class, 'update'])-> name('setting.update');

Route::get('setting/showSelect', [SettingController::class, 'showSelect']) -> name('setting.showSelect');

Route::get('pais', [PaisController::class, 'index'])-> name('pais.index');

Route::resource('paginateartist',PaginateArtistController::class);
Route::get('paginateartist2',[PaginateArtistController::class, 'index2'])->name('paginateartist.index2');