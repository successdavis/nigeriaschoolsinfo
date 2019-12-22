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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::post('api/{school}/addlogo', 'SchoolLogoController@store')->name('school.logo')->middleware('auth');

Route::get('/', 'PostController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/posts/{post}', 'PostController@show')->name('post.show');
Route::post('/schools/createschool', 'SchoolsController@store')->name('schools.store');