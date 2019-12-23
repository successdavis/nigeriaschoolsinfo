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
Route::post('api/{exams}/attachlogo', 'ExamsLogoController@store')->name('exam.logo')->middleware('admin');

Route::get('/', 'PostController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/posts/{post}', 'PostController@show')->name('post.show');

Route::get('/exams', 'ExamsController@index')->name('exams.index');
Route::get('/exams/{exams}', 'ExamsController@show')->name('exams.index');


Route::get('/schools', 'SchoolsController@index')->name('schools.index');
Route::get('/schools/{school}', 'SchoolsController@show')->name('schools.show');
Route::post('/schools/createschool', 'SchoolsController@store')->name('schools.store');