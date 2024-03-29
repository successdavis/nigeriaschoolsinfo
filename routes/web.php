<?php

Auth::routes(['verify' => true]);

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::post('/email/verification-notification', function (Request $request) {
    Auth()->user()->sendEmailVerificationNotification();

    return back()->with('flash', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/post-category/{category}', 'PostcategoryController@show')->name('category.show');


Route::post('api/{school}/addlogo', 'SchoolLogoController@store')->name('school.logo')->middleware(['auth','verified']);
Route::post('api/{exams}/attachlogo', 'ExamsLogoController@store')->name('exam.logo')->middleware(['auth','verified']);

Route::get('api/advertisements', 'AdvertisementsController@index')->name('advertisements.index');
Route::get('/api/statelocalgovernments', 'LocationController@index')->name('statelocal.index');

Route::post('/api/schoolcourseattachment', 'CourseSchoolAttachmentController@store')->name('courseschool.store');
Route::delete('/api/schoolcoursedetachment', 'CourseSchoolAttachmentController@destroy')->name('courseschool.delete');
Route::post('/api/schoolcourseattachmany/{course}', 'CourseSchoolAttachmentController@storeManySchools')->name('courseschool.storemany');
Route::post('/api/attachcoursestoschool/{schools}', 'CourseSchoolAttachmentController@storeManyCourses')->name('courseschool.storeManyCourses');
Route::delete('/api/detachcoursestoschool/{schools}', 'CourseSchoolAttachmentController@destroyManyCourses')->name('courseschool.deleteManyCourses');

// '/course/' . $this->course->slug .'/attachSubject'
Route::post('/api/{course}/attachSubject', 'AttachSubjectController@store')->name('attachsubject.store');
Route::post('/api/{course}/attachManySubject', 'AttachSubjectController@storemany');
Route::get('/api/{course}/getsubjects', 'AttachSubjectController@index');

// Route::post('/api/{course}/addconsideration', 'ConsiderationController@store');
// Route::get('/api/{course}/getconsiderations', 'ConsiderationController@index');
// Route::delete('/api/{consideration}/delete', 'ConsiderationController@destroy');


Route::get('/api/schools/{type}', 'ApiController@getschools');


Route::get('/latest-nigeria-education-news', 'PostController@index')->name('news.education');

Route::get('/', 'PostController@index')->name('application.index');

Route::get('/testpage', 'TestController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/posts/newpost', 'PostController@create')->name('post.create');
Route::get('/posts/newpostrequirements', 'PostController@newpostrequirement');
Route::get('/posts/relatedpost', 'PostController@relatedpost');
Route::get('/editpost/{post}', 'PostController@edit')->middleware('admin');
Route::post('/posts/savepost', 'PostController@store')->name('post.store');
Route::patch('/posts/updatepost/{post}', 'PostController@update')->name('post.update');
Route::get('/posts/{post}', 'PostController@show')->name('post.show');
Route::post('/posts/{post}/featured_image', 'PostImageController@store')->name('posts.featured_image');
Route::delete('/{post}/delete', 'PostController@destroy')->name('posts.delete');

Route::patch('/posts/{post}/togglepublish', 'PublishPostController@store');
Route::delete('/posts/{post}/togglepublish', 'PublishPostController@destroy');

Route::patch('{post}/followup', 'FollowupController@store')->middleware('admin');
Route::delete('{post}/followup', 'FollowupController@destroy')->middleware('admin');



Route::post('/posts/postimages', 'PostImageController@addimage')->name('posts.images');
Route::post('/posts/{post}/lock', 'LockPostController@store')->name('post.lock');
Route::post('/posts/{post}/unlock', 'LockPostController@delete')->name('post.unlock');

Route::get('/exams', 'ExamsController@index')->name('exams.index');
Route::get('/exams/{exams}', 'ExamsController@show')->name('exams.show');

// /schools/type/university?a=admitting&page=1

Route::get('/schools', 'SchoolsController@index')->name('schools.index');
Route::get('/schools/{school}', 'SchoolsController@show')->name('schools.show');
Route::get('/schools/programme/{programme}', 'SchoolsController@index')->name('schoolsInType');

// Route::get('/find/school', 'SchoolsController@findschool')->name('schools.findschool');

Route::get('/editschool/{school}', 'SchoolsController@create')->name('schools.edit');
Route::post('/schools/createschool', 'SchoolsController@store')->name('schools.store')->middleware(['auth','verified']);
Route::patch('/schools/{school}/update', 'SchoolsController@update')->name('schools.update');
Route::patch('/schools/{school}/admission', 'SchoolsController@openAdmission')->name('schools.admission');
Route::delete('/schools/{school}/admission', 'SchoolsController@closeAdmission')->name('schools.closeadmission');
Route::get('/schools/{school}/edit', 'SchoolsController@edit');

// return the requirement needed to create a new school
Route::get('/createSchoolRequirements', 'SchoolsController@cschoolrequirements')->name('schools.cschoolrequirements');

Route::get('/schoolsnotattached/{course}', 'CourseSchoolAttachmentController@getNotLinkedSchools')->name('courses.getNotLinkedSchools');
Route::get('/schoolsattached/{course}', 'CourseSchoolAttachmentController@getLinkedSchools')->name('courses.getLinkedSchools');

Route::post('/school/{schools}/addphoto', 'SchoolphotosController@store')->name('photos.store')->middleware(['auth','verified']);
Route::delete('/schoolphotos/{photo}/removephoto', 'SchoolphotosController@destroy')->name('photos.destroy')->middleware(['auth','verified']);
Route::get('/api/{schools}/schoolphotos', 'SchoolphotosController@index')->name('photos.show');

Route::get('/coursesnotattached/{school}', 'CourseSchoolAttachmentController@getNotLinkedCourses')->name('courses.getNotLinkedCourses');
// This url change from /coursesattached/{school}
Route::get('/courses-offered-in/{school}', 'CourseSchoolAttachmentController@getLinkedCourses')->name('courses.getLinkedCourses');

Route::get('/programme/{programme}/courses', 'CoursesController@index')->name('courses.programme.index');

Route::get('/schools-offering/{course}', 'CoursesController@getschools');

Route::get('/schools/{schools}/coursesnotoffered', 'CourseSchoolAttachmentController@coursesnotoffered');

// was previously /courses
Route::get('/courses-offered-in-nigeria-institutions', 'CoursesController@index')->name('courses.index');
Route::get('/courseswithschoolattach/{schools}', 'CourseSchoolAttachmentController@courses');
Route::get('/editcourse/{course}', 'CoursesController@edit')->name('courses.edit')->middleware(['auth','verified']);

Route::get('/course/{courses}', 'CoursesController@show')->name('courses.show');
Route::post('/courses/createcourse', 'CoursesController@store')->name('courses.store')->middleware(['auth','verified']);
Route::get('/find/courses', 'CoursesController@findcourses')->name('courses.find');
Route::get('/newcourse/courserequirements', 'CoursesController@getrequirements');
Route::patch('/updatecourse/{courses}', 'CoursesController@update')->middleware(['auth','verified']);


Route::get('/faculty/{faculty}', 'FacultiesController@show')->name('faculty.show');
// change from getfaculties to list-of-faculties
Route::get('/list-of-faculties', 'FacultiesController@index');

Route::post('/comments/newcomment', 'CommentController@store')->name('comment.store')->middleware(['auth','verified']);

Route::get('/comments', 'CommentController@index')->name('comment.index');
// Temporarily Disabled
// Route::get('/posts/{post}/comments', 'CommentController@index')->name('comment.index');

Route::delete('/comment/{comment}/destroy', 'CommentController@destroy')->name('comment.destroy')->middleware(['auth','verified']);
Route::patch('/comment/{comment}/update', 'CommentController@update')->name('comment.update')->middleware(['auth','verified']);


Route::post('/projects/{project}/uploadmaterial', 'UploadProjectController@store')->name('project.upload')->middleware(['auth','verified']);
Route::post('/projects/newproject', 'ProjectController@store')->name('project.store')->middleware(['auth','verified']);
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
Route::get('/educationlevels', 'ProgrammeController@index')->name('schooltype.index');


Route::post('/initializepayment', 'PaymentController@create')->name('payment.create')->middleware(['auth','verified']);
Route::post('/payment/{payment}', 'PaymentController@store')->name('payment.store')->middleware(['auth','verified']);

Route::get('/latest-job-opportunities-and-application', 'JobController@index')->name('jobs.index');
Route::get('/create-a-new-job', 'JobController@create')->middleware(['auth','verified']);
Route::get('/edit-job/{job}', 'JobController@edit')->name('jobs.create')->middleware(['auth','verified']);
Route::post('/jobs/create', 'JobController@store')->name('jobs.store')->middleware(['auth','verified']);
Route::patch('/jobs/{job}/update', 'JobController@update')->name('jobs.update')->middleware(['auth','verified']);
Route::get('/jobs/{job}', 'JobController@show')->name('jobs.show');
Route::post('/jobs/{job}/featured_image', 'JobController@featured_image')->name('jobs.featured_image')->middleware(['auth','verified']);

Route::get('/latest-scholarships-opportunities-for-application', 'ScholarshipController@index');
Route::post('/scholarships/create', 'ScholarshipController@store');
Route::get('/scholarships/create-a-new-scholarship', 'ScholarshipController@create');
Route::get('/scholarship/{scholarship}', 'ScholarshipController@show');
Route::get('/edit-scholarship/{scholarship}', 'ScholarshipController@edit');
Route::patch('/updatescholarship/{scholarship}', 'ScholarshipController@update')->name('scholarship.update');

Route::post('/categories/newcategory', 'PostcategoryController@store')->name('category.store')->middleware(['auth','verified']);
Route::get('/categories', 'PostcategoryController@index')->name('category.index');
