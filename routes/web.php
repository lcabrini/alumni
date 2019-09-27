<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/news', 'ArticleController@index')->name('news');

Route::get('/about', function() {
  return view('about');
})->name('about');

Route::get('/projects', function() {
  return view('projects');
})->name('projects');

/*
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
 */
