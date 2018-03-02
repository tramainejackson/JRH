<?php

namespace App\Http\Controllers;

use App\Property;
use App\PropertyImages;
use App\PropertyVideos;
use App\Settings;
use App\Files;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\File;
use Carbon\Carbon;

class PropertyController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::all();
        $settings = Settings::find(1);
		$deletedProps = Property::onlyTrashed()->get();
        return view('properties.index', compact('properties', 'deletedProps', 'settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$states = DB::select('select * from states');
		
        return view('properties.create', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'address' => 'required|max:150',
			'city' => 'required|max:100',
			'zip' => 'required|max:10',
			'description' => 'required|max:500',
			'price' => 'required',
		]);
		
		$property = new Property();
		
		$property->address = $request->address;
		$property->city = $request->city;
		$property->state = $request->state;
		$property->zip = $request->zip;
		$property->title = $request->title;
		$property->description = $request->description;
		$property->price = $request->price;
		$property->available_date = $request->available_date;
		$property->type = $request->type;
		$property->active = $request->active;
		$property->showcase = $request->showcase;
		$property->construction = $request->construction;
		$property->save();
		
		return redirect()->action('PropertyController@edit', $property)->with('status', 'Property Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
		$settings = Settings::find(1);
		$heroImage = $property->medias();
		$images = $property->medias;

        return view('properties.show', compact('property', 'settings', 'images', 'heroImage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
		$states = DB::select('select * from states');
		$documents = $property->documents;
		$tenant = $property->tenant;
		$startDate = new Carbon($property->available_date);
		
        return view('properties.edit', compact('property', 'states', 'tenant', 'documents', 'startDate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        $this->validate($request, [
			'address' => 'required|max:150',
			'city' => 'required|max:100',
			'zip' => 'required|max:10',
			'description' => 'required|max:500',
			'price' => 'required',
		]);
		
		$error = "";
		$property->address = $request->address;
		$property->city = $request->city;
		$property->state = $request->state;
		$property->zip = $request->zip;
		$property->title = $request->title;
		$property->description = $request->description;
		$property->price = $request->price;
		$property->available_date = $request->available_date;
		$property->type = $request->type;
		$property->active = $request->active;
		$property->showcase = $request->showcase;
		$property->construction = $request->construction;
		
		if($request->hasFile('media')) {
			foreach($request->file('media') as $newImage) {
				// Check to see if upload is an image
				if($newImage->guessExtension() == 'jpeg' || $newImage->guessExtension() == 'png' || $newImage->guessExtension() == 'gif' || $newImage->guessExtension() == 'webp' || $newImage->guessExtension() == 'jpg') {
					$addImage = new PropertyImages();
					
					// Check to see if images is too large
					if($newImage->getError() == 1) {
						$fileName = $request->file('media')[0]->getClientOriginalName();
						$error .= "<li class='errorItem'>The file " . $fileName . " is too large and could not be uploaded</li>";
					} elseif($newImage->getError() == 0) {
						// Check to see if images is about 25MB
						// If it is then resize it
						if($newImage->getClientSize() < 25000000) {
							$image = Image::make($newImage->getRealPath())->orientate();
							$path = $newImage->store('public/images');
							$image->save(storage_path('app/'. $path));

							$addImage->path = $path;
							$addImage->property_id = $property->id;
							
							$addImage->save();
						} else {
							// Resize the image before storing. Will need to hash the filename first
							$path = $newImage->store('public/images');
							$image = Image::make($newImage)->orientate()->resize(1500, null, function ($constraint) {
								$constraint->aspectRatio();
								$constraint->upsize();
							});
							$image->save(storage_path('app/'. $path));

							$addImage->property_id = $property->id;
							
							$addImage->save();
						}
					} else {
						$error .= "<li class='errorItem'>The file " . $fileName . " may be corrupt and could not be uploaded</li>";
					}
				} else {
					// Upload is not an image. Should be a video
					// May need to add an if to make sure its either an mp4 m4v or wmv or mov
					$addVideo = new PropertyVideos();

					$path = $newImage->store('public/videos');

					$addVideo->path = $path;
					$addVideo->property_id = $property->id;
					
					$addVideo->save();
				}
			}
		}
		
		if($request->hasFile('document')) {
			$parentID = Files::max('id');
			foreach($request->file('document') as $document) {
				$files = new Files();
				$files->title = $request->document_title;
				$files->property_id = $property->id;
				$files->parent_doc = $parentID + 1;
				$files->name = $path = $document->store('public/files');

				if($document->guessExtension() == 'png' || $document->guessExtension() == 'jpg' || $document->guessExtension() == 'jpeg' || $document->guessExtension() == 'gif' || $document->guessExtension() == 'bmp') {
					// Document is an image
					$image = Image::make($document->getRealPath())->orientate();
					$image->save(storage_path('app/'. $path));
				}
				
				if($files->save()) {}
			}
		}
		
		if($property->save()) {
			return redirect()->action('PropertyController@edit', $property)->with('status', 'Property Updated Successfully');
		} else {
			
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        $property->delete();
		return redirect()->action('PropertyController@index', $property)->with('status', 'Property Deleted Successfully');
    }
	
	/**
     * Restore the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
		$property = Property::onlyTrashed()->where('id', $id)->first();
		
		if($property != null) {
			$property->restore();
		}
		
		return redirect()->action('PropertyController@index', $property)->with('status', 'Property Restored Successfully');
    }
}
