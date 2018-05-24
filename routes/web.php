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
    return view('index');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/course/create', function () {
    return view('new-course');
});

Route::get('/compare', 'HomeworkController@compare')->name('compare');
Route::post('/compare-action', 'HomeworkController@compareAction')->name('compare');


Route::resource('homework', 'HomeworkController');

Route::post('/course/{slug}/subscribe', 'CourseController@subscribe')->middleware('auth');
Route::resource('course', 'CourseController');

Route::get('filter-courses', 'CourseController@getFilteredCourses');

Route::resource('upload', 'UploadController');
Route::get('/uploads/checked/{slug}', 'UploadController@getCheckedUploads');
Route::get('/uploads/unchecked{slug}', 'UploadController@getUncheckedUploads');
Route::get('/uploads/new/{slug}', 'UploadController@getNewUploads');

Route::get('/notifications', function() {
    return view('notifications');
});

Route::get('/deadlines', 'DeadlineController@index');

Route::get('/settings', function() {
    return view('settings');
});


Route::get('/contact', function () {
    return view('contact');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/grades-history', function () {
    return view('grades-history');
});

Route::get('/download/{path}', 'UploadController@download')->name('download');

Route::post('/upload-action', 'HomeworkController@uploadHomework')->name('upload-action')->middleware('auth');

Route::get('/upload/{slug}', 'HomeworkController@uploadView');

Route::get('/stud-uploads', 'HomeworkController@studentUploadsView');

Route::get('/stud-uploads/{user_id}/{slug}', 'HomeworkController@studentUploadView');

Route::post('grade-action', 'HomeworkController@updateGrade')->name('grade-action');

Route::get('/login', 'LoginController@index')->name('login');
Route::post('/login-action', 'LoginController@authenticate')->name('login-action');

Route::get('/logout', 'LoginController@logout')->name('logout');


Route::get('/register', 'RegisterController@index')->name('register');
Route::post('/register', 'RegisterController@register')->name('register');


Route::post('comments-action', 'HomeworkController@uploadComment')->middleware('auth');



Route::get('/profile', 'ProfileController@index')->name('profile');
Route::get('/forgot', 'ProfileController@forgot')->name('forgot');
Route::post('/forgot', 'ProfileController@sendToken')->name('reset-password');
Route::get('/reset/{user_mail}/{token}', 'ProfileController@newPassword');
Route::post('/reset', 'ProfileController@setNewPassword');

Route::post('reset-password-action', 'ProfileController@changePassword')->name('reset-password-action');

Route::post('reset-email-action', 'ProfileController@changeEmail')->name('reset-email-action');

Route::get('/admin', 'AdminController@index');
