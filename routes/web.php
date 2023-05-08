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


Auth::routes();
Route::middleware('auth')  //si collega alla cartella middleware
    ->namespace('admin')  //controller inseriti in sottocartella Admin
    ->name('admin.')      //name delle rotte che iniziano con admin.  //cartella admin dove dentro ci sono i file
    ->prefix('admin')
    ->group(function () {
        Route::get('/', function () {
            return view('admin.home');});// rotta se utente autenticato
        Route::prefix('cv')->group(function () {
            Route::get('/view', [CVController::class, 'view'])->name('cv.view');
            Route::get('/download', [CVController::class, 'download'])->name('cv.download');
        });
        Route::resource('portfolios', 'PortfolioController')->except('show');
        Route::resource('sections', 'SectionController')->parameters(['sections'=>'section:slug']);
        Route::resource('projects', 'ProjectController')->parameters(['projects'=>'project:slug']);
        Route::resource('skills', 'SkillController')->except(['show','create','edit'])->parameters(['skills'=>'skill:slug']);
        Route::resource('contacts', 'ContactController')->parameters(['contacts'=>'contact:slug']);
        Route::resource('icons', 'IconController')->parameters(['icons'=>'icon:slug']);
    });
Route::get('/home', 'HomeController@index')->name('home');
// Route::get('{any?}', function() {  // or any other path returns home.home in view
//     return view("home.home");
//  })->where("any", ".*");



