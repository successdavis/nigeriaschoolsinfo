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
Route::get('/api/statelocalgovernments', 'LocationController@index')->name('statelocal.index');

Route::post('/api/schoolcourseattachment', 'CourseSchoolController@store')->name('courseschool.store');
Route::delete('/api/schoolcoursedetachment', 'CourseSchoolController@destroy')->name('courseschool.delete');
Route::post('/api/schoolcourseattachmany/{course}', 'CourseSchoolController@storemany')->name('courseschool.storemany');

// '/course/' . $this->course->slug .'/attachSubject'
Route::post('/api/{course}/attachSubject', 'AttachSubjectController@store')->name('attachsubject.store');
Route::post('/api/{course}/attachManySubject', 'AttachSubjectController@storemany');
Route::get('/api/{course}/getsubjects', 'AttachSubjectController@index');

Route::post('/api/{course}/addconsideration', 'ConsiderationController@store');
Route::get('/api/{course}/getconsiderations', 'ConsiderationController@index');
Route::delete('/api/{consideration}/delete', 'ConsiderationController@destroy');


Route::get('/api/schools/{type}', 'ApiController@getschools');



Route::get('/', 'PostController@index');
Route::get('/testpage', 'TestController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/posts/newpost', 'PostController@create')->name('post.create')->middleware('admin');
Route::get('/posts/newpostrequirements', 'PostController@newpostrequirement')->middleware('admin');
Route::get('/posts/relatedpost', 'PostController@relatedpost');
Route::post('/posts/publishpost', 'PostController@store')->name('post.store')->middleware('admin');
Route::patch('/posts/updatepost/{post}', 'PostController@update')->name('post.update')->middleware('admin');
Route::get('/posts/{post}', 'PostController@show')->name('post.show');

Route::post('/posts/postimages', 'PostController@addimage')->name('posts.images')->middleware('admin');

Route::get('/exams', 'ExamsController@index')->name('exams.index');
Route::get('/exams/{exams}', 'ExamsController@show')->name('exams.index');

// /schools/type/university?a=admitting&page=1

Route::get('/schools', 'SchoolsController@index')->name('schools.index');
Route::get('/schools/type/{schooltype}', 'SchoolsController@index')->name('schoolsInType');
Route::get('/schools/{school}', 'SchoolsController@show')->name('schools.show');
Route::post('/schools/createschool', 'SchoolsController@store')->name('schools.store')->middleware('admin');
Route::get('/find/school', 'SchoolsController@findschool')->name('schools.findschool');
Route::get('/createSchoolRequirements', 'SchoolsController@cschoolrequirements')->name('schools.cschoolrequirements');
Route::get('/courses/getschools', 'SchoolsController@index')->name('courses.getschools');

Route::get('/schoolsofferedby/{course}', 'CoursesController@getschools');


Route::get('/schools/{schools}/courses', 'CoursesController@index')->name('schoolCourses');

Route::get('/courses', 'CoursesController@index')->name('courses.index');
Route::get('/courses/editcourse/{course}', 'CoursesController@edit')->name('courses.edit')->middleware('admin');

Route::get('/course/{courses}', 'CoursesController@show')->name('courses.show');
Route::post('/courses/createcourse', 'CoursesController@store')->name('courses.store');
Route::get('/find/courses', 'CoursesController@findcourses')->name('courses.find');
Route::get('/newcourse/courserequirements', 'CoursesController@getrequirements');


Route::get('/faculty/{faculty}', 'FacultiesController@show')->name('faculty.show');
Route::get('/getfaculties', 'FacultiesController@getfaculties')->name('schoolCourses');

Route::post('/posts/{post}/newcomment', 'CommentController@store')->name('comment.store')->middleware('auth');
Route::get('/posts/{post}/comments', 'CommentController@index')->name('comment.index');




