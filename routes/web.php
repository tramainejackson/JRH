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
Route::get('/test', function() {
	$contact = \App\Contact::find(1);

    return view('test', compact('contact'));
})->name('test');

Route::get('/contact_us', function() {
	$setting = \App\Settings::find(1);
    return view('contact_us', compact('setting'));
})->name('contact_us');

Route::get('/about_us', function() {
	$setting = \App\Settings::find(1);
    return view('about_us', compact('setting'));
})->name('about_us');

Auth::routes();

Route::get('/construction', 'ConstructionController@index');

Route::get('/', 'HomeController@welcome')->name('welcome');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/property_restore/{id}', 'PropertyController@restore');

Route::get('/contact_restore/{id}', 'ContactController@restore');

// Generate and send email from contact edit page
Route::post('/contact_restore/{contact}/send_mail', 'ContactController@send_mail');

// Generate a rent reminder email
Route::post('/contact_restore/{contact}/rent_reminder', 'ContactController@rent_reminder');

Route::post('/new_message', 'MessageController@store');

// Ajax request. Change properties default image
Route::post('/default_image', 'PropertyImagesController@default_image');

Route::delete('/remove_images', 'PropertyImagesController@remove_images');

Route::delete('/remove_videos', 'PropertyImagesController@remove_videos');

Route::resource('contacts', 'ContactController');

Route::resource('properties', 'PropertyController');

Route::resource('settings', 'SettingsController');

Route::resource('admin_files', 'FilesController');

Auth::routes();
