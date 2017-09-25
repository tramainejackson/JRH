<?php

namespace App\Http\Controllers;

use App\Property;
use App\PropertyImages;
use App\Settings;
use Illuminate\Http\Request;

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
        return view('properties.create');
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
			'description' => 'required|max:500',
			'price' => 'required',
		]);
		
		$property = new Property();
		
		$property->address = $request->address;
		$property->title = $request->title;
		$property->description = $request->description;
		$property->price = $request->price;
		$property->active = $request->active;
		$property->rental = $request->rental;
		$property->showcase = $request->showcase;
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
        return view('properties.show', compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        return view('properties.edit', compact('property'));
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
			'description' => 'required|max:500',
			'price' => 'required',
		]);
		
		$property->address = $request->address;
		$property->title = $request->title;
		$property->description = $request->description;
		$property->price = $request->price;
		$property->active = $request->active;
		$property->rental = $request->rental;
		$property->showcase = $request->showcase;
		
		if ($request->hasFile('media')) {
			$img = new PropertyImages();
			$path = $request->file('media')->store('public/images');
			$img->path = $path;
			$img->property_id = $property->id;
		}
		
		if($property->save()) {
			if ($request->hasFile('media')) {
				$img->save();
			}
		}

		return redirect()->action('PropertyController@show', $property)->with('status', 'Property Updated Successfully');
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
    public function restore(Property $property)
    {
		dd($property);
        $property->restore();
		return redirect()->action('PropertyController@index', $property)->with('status', 'Property Restored Successfully');
    }
}
