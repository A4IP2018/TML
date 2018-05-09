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

Route::get('/upload', function () {
    return view('upload');
});

Route::get('/new-course', function () {
    return view('new-course');
});

Route::get('/courses', function() {
    return view('courses');
});

Route::get('/course-sg', function() {
    return view('course-sg');
});

Route::get('/new-homework', function () {
    return view('new-homework');
});

Route::get('/homework', function() {
    return view('homework');
});

Route::get('/homework-sg', function () {
    return view('homework-sg');
});

Route::get('/messages', function() {
    return view('messages');
});

Route::get('/reviews', function() {
    return view('reviews');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/login', 'LoginController@index')->name('login');
Route::post('/login-action', 'LoginController@authenticate')->name('login-action');

Route::get('/logout', 'LoginController@logout')->name('logout');


Route::get('register', 'RegisterController@index')->name('register');

Route::post('register-action', 'RegisterController@registerAction')->name('register-action');
