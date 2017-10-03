<?php

namespace App\Http\Controllers;

use App\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $settings = Settings::find(1);
        // return view('settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function show(Settings $settings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function edit(Settings $setting)
    {
        return view('settings.edit', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Settings $setting)
    {
		$setting->show_welcome = $request->show_welcome;
		$setting->welcome_content = $request->welcome_content;
		$setting->mission = $request->mission;
		$setting->email = $request->email;
		$setting->phone = $request->phone;
		$setting->show_deletes = $request->show_deletes;
		$path = '';
		
		if ($request->hasFile('welcome_media')) {
			$setting->welcome_media = $request->file('welcome_media')->store('public/images');
		}
		
		if ($request->hasFile('carousel_images')) {
			$path = $request->file('carousel_images')->store('public/images');
			$setting->carousel_images != '' ? $setting->carousel_images .= "; " . str_ireplace('public/images/', '', $path) : $setting->carousel_images = str_ireplace('public/images/', '', $path);
		}
		
		$setting->save();

		return redirect()->action('SettingsController@edit', $setting)->with('status', 'Settings Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Settings $settings)
    {
        //
    }
}
