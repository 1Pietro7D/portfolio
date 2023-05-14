<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\CVController;

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

// route for frontApi
Route::get('/', function () {
    return view('layouts.app-front');
}); // return only view

Route::prefix('cv')->group(function () {
    Route::get('/view', [CVController::class, 'view'])->name('cv.view');
    Route::get('/download', [CVController::class, 'download'])->name('cv.download');
});

Route::get('/back', 'HomeController@index')->name('home');
Auth::routes();
Route::middleware('auth')  //si collega alla cartella middleware
    ->namespace('admin')  //controller inseriti in sottocartella Admin
    ->name('admin.')      //name delle rotte che iniziano con admin.  //cartella admin dove dentro ci sono i file
    ->prefix('admin')
    ->group(function () {

        Route::get('/home', function () {
            return view('admin.home'); // HOME of ADMIN
        });// route for user autenticate

        Route::resource('portfolios', 'PortfolioController')->except('show');
        Route::resource('sections', 'SectionController')->except(['show','create','edit'])->parameters(['sections'=>'section:slug']);
        Route::resource('projects', 'ProjectController')->parameters(['projects'=>'project:slug']);
        Route::resource('skills', 'SkillController')->except(['show','create','edit'])->parameters(['skills'=>'skill:slug']);
        Route::resource('contacts', 'ContactController')->parameters(['contacts'=>'contact:slug']);
        Route::resource('icons', 'IconController')->except(['show','create','edit'])->parameters(['icons'=>'icon:slug']);
    });


// Route::get('{any?}', function() {  // or any other path returns home.home in view
//     return view("home.home");
//  })->where("any", ".*");



