<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\FiliereController;
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
    return redirect('/admin/login');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::post('/admin/stats',[ClasseController::class, 'stats'])->name('statistique');
Route::post('/admin/classeparfiliere/affichefiliere',[FiliereController::class, 'affiche'])->name('filieresaffiche');
Route::post('/admin/classeparfiliere/afficheclasse',[ClasseController::class, 'affiche'])->name('classeaffiche');
Route::post('/admin/classeparfiliere/search',[ClasseController::class, 'search'])->name('searchbyfiliere');
Route::post('/admin/classeparfiliere/deleteclasse',[ClasseController::class, 'delete'])->name('deleteclasse');
Route::post('/admin/classeparfiliere/updateclasse',[ClasseController::class, 'update'])->name('updateclasse');
Route::get('/admin/classeparfiliere', function(){
    return view('clparfiliere');
});