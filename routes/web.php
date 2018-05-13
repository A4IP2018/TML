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

Route::get('/new-course', function () {
    return view('new-course');
});

Route::get('/compare', function () {
    return view('compare');
});

Route::get('/forum', function () {
    return view('forum');
});

Route::resource('homework', 'HomeworkController');

Route::resource('course', 'CourseController');


Route::get('/messages', function() {
    return view('messages');
});

Route::get('/request', function () {
    return view('request');
});

Route::get('/messages-sg', function() {
    return view('messages-sg');
});

Route::get('/settings', function() {
    return view('settings');
});

Route::get('/home', 'HomeController@index')->name('home');



Route::post('/upload-action', 'HomeworkController@uploadHomework')->name('upload-action')->middleware('auth');

Route::get('/upload/{slug}', 'HomeworkController@uploadView');

Route::get('/stud-uploads', 'HomeworkController@studentUploadsView');

Route::get('/stud-uploads/{user_id}/{slug}', 'HomeworkController@studentUploadView');


Route::post('grade-action', 'HomeworkController@updateGrade')->name('grade-action');

Route::get('/login', 'LoginController@index')->name('login');
Route::post('/login-action', 'LoginController@authenticate')->name('login-action');

Route::get('/logout', 'LoginController@logout')->name('logout');


Route::get('register', 'RegisterController@index')->name('register');

Route::post('register-action', 'RegisterController@registerAction')->name('register-action');

Route::post('comments-action', 'HomeworkController@uploadComment')->middleware('auth');


Route::post('comments-action', 'HomeworkController@uploadComment')->middleware('auth');

Route::get('/view-homework', 'AddHomeWorkController@insert_homework_form');
Route::post('/add-homework', 'AddHomeWorkController@insert_new_homework')->middleware('auth');


