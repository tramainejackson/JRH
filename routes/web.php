<?php
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

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
// Route::get('/test', function() {
	// $contact = \App\Contact::find(1);
	// $setting = \App\Settings::find(1);
	// $subject = 'Test Subject';
	// $body = "Some blurb for the body";
	// $amount = 50;
	// $token = 1;

    // return view('test', compact('contact', 'amount', 'body', 'subject', 'setting', 'token'));
// })->name('test');

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

Route::post('/new_message', 'MessageController@store');

Route::post('/reset_count', 'HomeController@reset_counter');

// Get the calendar for property showings
Route::get('/calendar', function() {
	$showDate = Carbon::now();
	$todayShowings = App\PropertyShowing::where('show_date', $showDate->toDateString())->get();

    return view('calendar', compact('showDate', 'todayShowings'));
})->name('calendar');

// Restore the removed property
Route::post('/properties/{property}/remove_tenant', 'PropertyController@remove_tenant');

// Restore the removed property
Route::get('/property_restore/{id}', 'PropertyController@restore');

// Get all showings on calendar for a specific date
Route::get('/property_showings/{date}', 'PropertyController@get_showings');

// Remove deleted property showing
Route::delete('/property_showings/{propertyShowing}', 'PropertyController@remove_showing');

// Update selected property showing
Route::patch('/property_showings/{propertyShowing}', 'PropertyController@update_showing');

// Add A Showing To Calendar For Property
Route::post('/property_showing/{property}', 'PropertyController@add_showing');

// Restore the removed contact
Route::get('/contact_restore/{id}', 'ContactController@restore');

// Generate and send email from contact edit page
Route::post('/contacts/{contact}/send_mail', 'ContactController@send_mail');

// Generate and send email from contact edit page
Route::post('/contacts/mass_email', 'ContactController@mass_email');

// Generate a rent reminder email
Route::post('/contacts/{contact}/rent_reminder', 'ContactController@rent_reminder');

// Remove the link between contact and property from the contact edit page
Route::post('/contacts/{contact}/remove_as_tenant', 'ContactController@remove_as_tenant');

// Search for the name of the contact listed
Route::post('/contacts_search', 'ContactController@search');

// Contacts page to address any duplicate records
Route::get('/contacts_duplicated', 'ContactController@duplicates')->name('contacts.dupes');

// Complete link/ignore request for potential duplicate accounts
Route::patch('/duplicate_link/{contact}', 'ContactController@duplicate_link');

// Ajax request. Change properties default image
Route::post('/default_image', 'PropertyImagesController@default_image');

// Ajax request. Remove individual requirement
Route::delete('/remove_requirement/{propertyRequirement}', 'PropertyRequirementController@remove_requirement');

Route::delete('/remove_images', 'PropertyImagesController@remove_images');

Route::delete('/remove_videos', 'PropertyImagesController@remove_videos');

Route::resource('contacts', 'ContactController');

Route::resource('properties', 'PropertyController');

Route::resource('settings', 'SettingsController');

Route::resource('admin_files', 'FilesController');

Auth::routes();
