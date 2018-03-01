<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;
use App\ContactImages;
use App\Settings;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\File;

class ContactImagesController extends Controller
{
	/**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function remove_images(Request $request)
    {
		$images = $request->remove_image;
		$property = Property::find($request->prop);
		
		foreach($images as $image) {
			$removeImage = PropertyImages::find($image);
			
			if($removeImage->delete()) {
				Storage::delete($removeImage->path);
			}
		}

		return redirect()->action('PropertyController@index', $property)->with('status', 'Property Image(s) Deleted Successfully');
    }
	
	/**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function remove_videos(Request $request)
    {
		$videos = $request->remove_video;
		$property = Property::find($request->prop);
		
		foreach($videos as $video) {
			$removeVideo = PropertyVideos::find($video);
			
			if($removeVideo->delete()) {
				Storage::delete($removeVideo->path);
			}
		}

		return redirect()->action('PropertyController@index', $property)->with('status', 'Property Video(s) Deleted Successfully');
    }
}
