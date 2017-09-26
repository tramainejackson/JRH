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

Route::get('/about_us', function() {
	$setting = \App\Settings::find(1);
    return view('about_us', compact('setting'));
})->name('about_us');

Route::get('/contact_us', function() {
	$setting = \App\Settings::find(1);
    return view('contact_us', compact('setting'));
})->name('contact_us');


Route::get('/', 'HomeController@welcome')->name('welcome');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/property_restore/{id}', 'PropertyController@restore');

Auth::routes();

Route::resource('contacts', 'ContactController');

Route::resource('properties', 'PropertyController');

Route::resource('settings', 'SettingsController');

