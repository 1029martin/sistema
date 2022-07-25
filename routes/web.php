<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudianteController;

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
    return view('auth.login');
});


/*Route::get('/estudiante', function () {
    return view('estudiante.index');
});

Route::get('/estudiante/create',[EstudianteController::class,'create']); 
*/
Route::resource('estudiante', EstudianteController::class)->middleware('auth');

Auth::routes(['register'=>false,'reset'=>false]);

Route::get('/home', [EstudianteController::class, 'index'])->name('home');

Route::group(['middleware'=> 'auth'], function () {
    
    Route::get('/', [EstudianteController::class, 'index'])->name('home');

});
