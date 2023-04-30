<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')  //si collega alla cartella middleware
    ->namespace('admin')  //controller inseriti in sottocartella Admin
    ->name('admin.')      //name delle rotte che iniziano con admin.  //cartella admin dove dentro ci sono i file
    ->prefix('admin')
    ->group(function () {
        Route::get('/', function () {
            return view('admin.test');
        });
    });

   Route::get('{any?}', function() {  // or any other path returns home.home in view
    return view("home.home");
    return view("layouts/app");
 })->where("any", ".*");



