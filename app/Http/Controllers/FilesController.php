<?php

namespace App\Http\Controllers;

use App\Files;
use App\Contact;
use App\Property;
use App\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilesController extends Controller
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
		$files = Files::all();
		$settings = Settings::find(1);
        return view('files.index', compact('settings', 'files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $properties = Property::all();
        $contacts = Contact::all();
		return view('files.create', compact('properties', 'contacts'));
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
			'name' => 'required',
			'title' => 'required|max:100',
		]);
		
		$files = new Files();
		
		$request->contact_id != "none" ? $files->contact_id = $request->contact_id : "";
		$request->property_id != "none" ? $files->property_id = $request->property_id : "";
		if($request->hasFile('name')) {
			$path = "";
			foreach($request->file('name') as $document) {
				$path .= $document->store('public/files');
				$path .= "; ";
			}
			
			//Find the lasy simi-colon and remove it
			$lastColon = strrpos($path, ";");
			$files->name = substr_replace($path, "", $lastColon, 1);
		}
		
		$files->title = $request->title;

		$files->save();
		
		return redirect()->action('FilesController@edit', $files)->with('status', 'File(s) Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Files  $files
     * @return \Illuminate\Http\Response
     */
    public function show(Files $files)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Files  $files
     * @return \Illuminate\Http\Response
     */
    public function edit($file)
    {
		$file = Files::find($file);
		
        return view('files.edit', compact('file'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Files  $files
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Files $files)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Files  $files
     * @return \Illuminate\Http\Response
     */
    public function destroy(Files $files)
    {
        //
    }
}
