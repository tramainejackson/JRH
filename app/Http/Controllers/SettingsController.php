<?php

namespace App\Http\Controllers;

use App\Settings;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\File;

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
		$error = '';
		$path = '';
		
		if($request->hasFile('welcome_media')) {
			$setting->welcome_media = $request->file('welcome_media')->store('public/images');
		}
		
		if($request->hasFile('carousel_images')) {
			// Check to see how many current images there are
			// and remove any if it exceeds 4
			$carouselCount = count(explode('; ', $setting->carousel_images));

			// if(($carouselCount + $uploadsCount) > 4) {
				// $dropAmount = ($carouselCount + $uploadsCount) - 4;
				// for($x=0; $x < $dropAmount; $x++) {
					// array_pop($request->carousel_images);
				// }
			// }

			for($x=0; $x < (4 - $carouselCount); $x++) {
				if(isset($request->file('carousel_images')[$x])) {
					// Check to see if images is too large
					$newImage = $request->file('carousel_images')[$x];
					if($newImage->getError() == 1) {
						$fileName = $request->file('carousel_images')[0]->getClientOriginalName();
						$error .= "<li class='errorItem'>The file " . $fileName . " is too large and could not be uploaded</li>";
					} elseif($newImage->getError() == 0) {
						// Check to see if images is about 25MB
						// If it is then resize it
						if($newImage->getClientSize() < 25000000) {
							$path = $newImage->store('public/images');
							$image = Image::make($newImage->getRealPath())->orientate();
							$image->save(storage_path('app/'. $path));

							$setting->carousel_images != '' ? $setting->carousel_images .= "; " . str_ireplace('public/images/', '', $path) : $setting->carousel_images = str_ireplace('public/images/', '', $path);
						} else {
							// Resize the image before storing. Will need to hash the filename first
							$path = $newImage->store('public/images');
							$image = Image::make($newImage)->orientate()->resize(1500, null, function ($constraint) {
								$constraint->aspectRatio();
								$constraint->upsize();
							});
							
							$image->save(storage_path('app/'. $path));

							$setting->carousel_images != '' ? $setting->carousel_images .= "; " . str_ireplace('public/images/', '', $path) : $setting->carousel_images = str_ireplace('public/images/', '', $path);
						}
					} else {
						$error .= "The file " . $fileName . " may be corrupt and could not be uploaded.";
					}
				}
			}
		}
		
		if($setting->save()) {
			return redirect()->action('SettingsController@edit', $setting)->with('status', 'Settings Updated Successfully');
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Settings  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Settings $setting)
    {
		$removeImage;
		
		if(preg_match("/(?<=\images\/)[^\]]+/", $request->carouselImageD, $imagePath)) {
			$removeImage = str_ireplace('/', '', $imagePath[0]);
			$setting->carousel_images = explode('; ', $setting->carousel_images);
			$newCarousel = array_diff($setting->carousel_images, $imagePath);
			$newCarousel = implode('; ', $newCarousel);
			$setting->carousel_images = $newCarousel;

			$setting->save();
			
			return redirect()->action('SettingsController@edit', $setting)->with('status', 'Settings Updated Successfully');
		}
		
    }
}
