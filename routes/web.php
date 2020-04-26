<?php

Auth::routes();

Route::get('/post-category/{category}', 'PostcategoryController@show')->name('category.show');


Route::post('api/{school}/addlogo', 'SchoolLogoController@store')->name('school.logo')->middleware('auth');
Route::post('api/{exams}/attachlogo', 'ExamsLogoController@store')->name('exam.logo')->middleware('admin');

Route::get('api/advertisements', 'AdvertisementsController@index')->name('advertisements.index');
Route::get('/api/statelocalgovernments', 'LocationController@index')->name('statelocal.index');

Route::post('/api/schoolcourseattachment', 'CourseSchoolAttachmentController@store')->name('courseschool.store');
Route::delete('/api/schoolcoursedetachment', 'CourseSchoolAttachmentController@destroy')->name('courseschool.delete');
Route::post('/api/schoolcourseattachmany/{course}', 'CourseSchoolAttachmentController@storemany')->name('courseschool.storemany');

// '/course/' . $this->course->slug .'/attachSubject'
Route::post('/api/{course}/attachSubject', 'AttachSubjectController@store')->name('attachsubject.store');
Route::post('/api/{course}/attachManySubject', 'AttachSubjectController@storemany');
Route::get('/api/{course}/getsubjects', 'AttachSubjectController@index');

Route::post('/api/{course}/addconsideration', 'ConsiderationController@store');
Route::get('/api/{course}/getconsiderations', 'ConsiderationController@index');
Route::delete('/api/{consideration}/delete', 'ConsiderationController@destroy');


Route::get('/api/schools/{type}', 'ApiController@getschools');


Route::get('/latest-nigeria-education-news', 'PostController@index')->name('news.education');

Route::get('/', 'ApplicationController@index');

Route::get('/testpage', 'TestController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/posts/newpost', 'PostController@create')->name('post.create')->middleware('admin');
Route::get('/posts/newpostrequirements', 'PostController@newpostrequirement')->middleware('admin');
Route::get('/posts/relatedpost', 'PostController@relatedpost');
Route::get('/editpost/{post}', 'PostController@edit')->middleware('admin');
Route::post('/posts/publishpost', 'PostController@store')->name('post.store')->middleware('admin');
Route::patch('/posts/updatepost/{post}', 'PostController@update')->name('post.update')->middleware('admin');
Route::get('/posts/{post}', 'PostController@show')->name('post.show');
Route::post('/posts/{post}/featured_image', 'PostController@featured_image')->name('posts.featured_image')->middleware('admin');


Route::post('/posts/postimages', 'PostController@addimage')->name('posts.images')->middleware('admin');
Route::post('/posts/{post}/lock', 'PostController@lock')->name('post.lock')->middleware('admin');
Route::post('/posts/{post}/unlock', 'PostController@unlock')->name('post.unlock')->middleware('admin');

Route::get('/exams', 'ExamsController@index')->name('exams.index');
Route::get('/exams/{exams}', 'ExamsController@show')->name('exams.index');

// /schools/type/university?a=admitting&page=1

Route::get('/schools', 'SchoolsController@index')->name('schools.index');
Route::get('/schools/type/{schooltype}', 'SchoolsController@index')->name('schoolsInType');
Route::get('/schools/{school}', 'SchoolsController@show')->name('schools.show');

Route::get('/find/school', 'SchoolsController@findschool')->name('schools.findschool');

Route::get('/createnewschool', 'SchoolsController@create')->name('schools.create')->middleware('admin');
Route::post('/schools/createschool', 'SchoolsController@store')->name('schools.store')->middleware('admin');

// return the requirement needed to create a new school
Route::get('/createSchoolRequirements', 'SchoolsController@cschoolrequirements')->name('schools.cschoolrequirements');

Route::get('/schoolsnotattached/{course}', 'CourseSchoolAttachmentController@getNotLinkedSchools')->name('courses.getNotLinkedSchools');
Route::get('/schoolsattached/{course}', 'CourseSchoolAttachmentController@getLinkedSchools')->name('courses.getLinkedSchools');

Route::get('/coursesnotattached/{school}', 'CourseSchoolAttachmentController@getNotLinkedCourses')->name('courses.getNotLinkedCourses');
// This url change from /coursesattached/{school}
Route::get('/courses-offered-in/{school}', 'CourseSchoolAttachmentController@getLinkedCourses')->name('courses.getLinkedCourses');

Route::get('/schools-offering/{course}', 'CoursesController@getschools');

Route::get('/schools/{schools}/courses', 'CoursesController@index')->name('schoolCourses');
Route::get('/schools/{schools}/coursesnotoffered', 'CourseSchoolAttachmentController@coursesnotoffered');

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
Route::delete('/comment/{comment}/destroy', 'CommentController@destroy')->name('comment.destroy');
Route::patch('/comment/{comment}/update', 'CommentController@update')->name('comment.update');


Route::post('/projects/{project}/uploadmaterial', 'UploadProjectController@store')->name('project.upload');
Route::post('/projects/newproject', 'ProjectController@store')->name('project.store');
Route::get('/nigeria-education-project-topics-and-materials', 'ProjectController@index')->name('project.index');
Route::get('/project/{project}', 'ProjectController@show')->name('project.show');
Route::patch('project/{project}/update', 'ProjectController@update')->name('project.update');
Route::get('/editproject/{project}', 'ProjectController@edit')->name('project.edit');

Route::get('download-{course}/projects-and-topics', 'ProjectController@index')->name('project.courses');
Route::get('/addprojectmaterial', 'ProjectController@create')->name('project.create');
Route::get('/download/{project}/file', 'ProjectController@download')->name('project.download');

Route::get('/projectscategories', 'ProjectcategoryController@index')->name('projectcategory.index');

// This method retrieve all the school types, 
// that's the level of education, nurse, nce, degree etc
Route::get('/educationlevels', 'EducationLevelController@index')->name('schooltype.index');


Route::post('/initializepayment', 'PaymentController@create')->name('payment.create');
Route::post('/payment/{payment}', 'PaymentController@store')->name('payment.store');

Route::get('/latest-job-opportunities-and-application', 'JobController@index')->name('jobs.index');
Route::get('/create-a-new-job', 'JobController@create')->name('jobs.create');
Route::get('/edit-job/{job}', 'JobController@edit')->name('jobs.create');
Route::post('/jobs/create', 'JobController@store')->name('jobs.store');
Route::patch('/jobs/{job}/update', 'JobController@update')->name('jobs.update');
Route::get('/jobs/{job}', 'JobController@show')->name('jobs.show');
Route::post('/jobs/{job}/featured_image', 'JobController@featured_image')->name('jobs.featured_image');

Route::get('/latest-scholarships-opportunities-for-application', 'ScholarshipController@index');
Route::post('/scholarships/create', 'ScholarshipController@store');
Route::get('/scholarships/create-a-new-scholarship', 'ScholarshipController@create');
Route::get('/scholarship/{scholarship}', 'ScholarshipController@show');
Route::get('/edit-scholarship/{scholarship}', 'ScholarshipController@edit');
Route::patch('/updatescholarship/{scholarship}', 'ScholarshipController@update')->name('scholarship.update');

Route::post('/categories/newcategory', 'PostcategoryController@store')->name('category.store')->middleware('admin');
Route::get('/categories', 'PostcategoryController@index')->name('category.index');
