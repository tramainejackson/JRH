<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;
use App\PropertyImages;
use App\PropertyVideos;
use App\Settings;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\File;

class PropertyImagesController extends Controller
{
	/**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function remove_images(Request $request)
    {
		if(isset($request->remove_image)) {
			$images = $request->remove_image;
			
			foreach($images as $image) {
				$removeImage = PropertyImages::find($image);
				
				if($removeImage->delete()) {
					Storage::delete($removeImage->path);
				}
			}
		}
		
		if(isset($request->remove_video)) {
			$videos = $request->remove_video;
			
			foreach($videos as $video) {
				$removeVideo = PropertyVideos::find($video);
				
				if($removeVideo->delete()) {
					Storage::delete($removeVideo->path);
				}
			}
		}

		return redirect()->back()->with('status', 'Property Media Items Deleted Successfully');
    }
	
	/**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function default_image(Request $request)
    {
		$image = PropertyImages::find($request->PropertyImages);
		$property = $image->property;
		$image->default_photo = 'Y';
		
		if($property->medias()->withTrashed()->where('default_photo', 'Y')) {
			// Make all default images null
			$property->medias()->withTrashed()->where('default_photo', 'Y')->update([
				'default_photo' => null
			]);

			if($image->save()) {}
		} else {
			if($image->save()) {}
		}
		
		return $image;
    }
}
