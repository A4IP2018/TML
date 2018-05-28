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

Route::get('/', 'HomeController@main');

Route::get('/compare', 'CompareController@index')->name('compare')->middleware('teacher');
Route::post('/compare', 'CompareController@statsPage')->middleware('teacher');
Route::get('/compare/{id}', 'CompareController@compareView')->middleware('auth');
Route::post('/compare/feedback', 'CompareController@registerFeedback')->middleware('auth');
Route::get('/compare/{id}/delete', 'CompareController@deleteCompare')->middleware('teacher');

Route::resource('homework', 'HomeworkController');

Route::post('/course/{slug}/subscribe', 'CourseController@subscribe')->middleware('auth');
Route::resource('course', 'CourseController');

Route::get('filter-courses', 'CourseController@getFilteredCourses');
Route::get('filter-homework', 'HomeworkController@getFilteredHomeworks');

Route::resource('upload', 'UploadController');
Route::get('/upload/{batch_id}/download', 'UploadController@downloadAll');

Route::get('/uploads/{meta}/{slug}', 'UploadController@showUploadsByFilter');


Route::get('/uploads/new/{slug}', 'UploadController@getNewUploads');

Route::get('/deadlines', 'DeadlineController@index');

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/grades-history', function () {
    return view('grades-history');
});

Route::get('/help', function () {
    return view('help');
});

Route::get('/download/{path}', 'UploadController@download')->name('download');

Route::post('/grade', 'HomeworkController@updateGrade')->name('grade');

Route::get('/login', 'LoginController@index')->name('login');
Route::post('/login-action', 'LoginController@authenticate')->name('login-action');

Route::get('/logout', 'LoginController@logout')->name('logout');


Route::get('/register', 'RegisterController@index')->name('register');
Route::post('/register', 'RegisterController@register')->name('register');
Route::get('/confirm/{token}', 'RegisterController@confirm');

Route::post('comments-action', 'HomeworkController@uploadComment')->middleware('auth');
Route::post('file-comments-action', 'UploadController@uploadComment')->middleware('auth');


/* PASSWORD RESET */
Route::get('/forgot', 'ProfileController@forgot')->name('forgot');
Route::post('/forgot', 'ProfileController@sendToken')->name('reset-password');
Route::get('/reset/{user_mail}/{token}', 'ProfileController@newPassword');
Route::post('/reset', 'ProfileController@setNewPassword');
/* PASSWORD RESET */

/* PROFILE */
Route::get('/profile', 'ProfileController@index')->name('profile')->middleware('auth');
Route::get('/user/{id}', 'ProfileController@user')->name('userProfile')->middleware('auth');
Route::post('change-password', 'ProfileController@changePassword')->name('reset-password-action')->middleware('auth');
Route::post('change-email', 'ProfileController@changeEmail')->name('reset-email-action')->middleware('auth');
Route::post('change-nr-matricol', 'ProfileController@changeNrMatricol')->name('reset-nr-matricol')->middleware('auth');
/* PROFILE */

/* NOTIFICATIONS */
Route::get('/notifications', 'NotificationController@index')->middleware('auth');
Route::post('/notifications/remove', 'NotificationController@remove')->middleware('auth');
/* NOTIFICATIONS */


Route::get('/admin', 'AdminController@index')->middleware('admin');

Route::get('/pdf-generator', 'AdminController@pdfGenerate');
