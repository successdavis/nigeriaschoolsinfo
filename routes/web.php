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

Route::get('api/advertisements', 'AdvertisementsController@index')->name('advertisements.index');
Route::get('/api/statelocalgovernments', 'LocationController@index')->name('advertisements.index');


Route::get('/', 'PostController@index');
Route::get('/testpage', 'TestController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/posts/{post}', 'PostController@show')->name('post.show');

Route::get('/exams', 'ExamsController@index')->name('exams.index');
Route::get('/exams/{exams}', 'ExamsController@show')->name('exams.index');


Route::get('/schools', 'SchoolsController@index')->name('schools.index');
Route::get('/schools/type/{schooltype}', 'SchoolsController@index')->name('schoolsInType');
Route::get('/schools/{school}', 'SchoolsController@show')->name('schools.show');
Route::post('/schools/createschool', 'SchoolsController@store')->name('schools.store')->middleware('admin');
Route::get('/find/school', 'SchoolsController@findschool')->name('schools.findschool');
Route::get('/createSchoolRequirements', 'SchoolsController@cschoolrequirements')->name('schools.cschoolrequirements');

Route::get('/schools/{schools}/courses', 'CoursesController@index')->name('schoolCourses');

Route::get('/courses', 'CoursesController@index')->name('courses.index');
Route::get('/courses/{courses}', 'CoursesController@show')->name('courses.show');


Route::get('/faculty/{faculty}', 'FacultiesController@show')->name('faculty.show');



