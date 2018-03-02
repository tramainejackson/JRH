<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Property;
use App\Settings;
use App\ContactImages;
use App\Files;
use App\Mail\Update;
use App\Mail\NewContact;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('store');
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$contacts = Contact::all();
		$settings = Settings::find(1);
		$deletedContacts = Contact::onlyTrashed()->get();
        return view('contacts.index', compact('contacts', 'deletedContacts', 'settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$properties = Property::all();
		return view('contacts.create', compact('properties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		if(Auth::guest()) {
			$this->validate($request, [
				'first_name' => 'required|max:30',
				'last_name' => 'required|max:30',
				'email' => 'required|max:50',
				'phone' => 'required|max:10',
			]);
			
			$contact = new Contact();
			$contact->first_name = $request->first_name;
			$contact->last_name = $request->last_name;
			$contact->email = $request->email;
			$contact->phone = $request->phone;
			$contact->family_size = $request->family_size == '' ? '1' : $request->family_size;
			$contact->tenant = 'N';

			if($contact->save()) {
				\Mail::to($contact->email)->send(new Update($contact));
				\Mail::to('lorenzodevonj@yahoo.com')->send(new NewContact($contact));
				
				return redirect('/')->with('status', 'You Have Been Added To Our Contact Successfully');			
			}
		} else {
			$this->validate($request, [
				'first_name' => 'required|max:30',
				'last_name' => 'required|max:30',
			]);
			
			$contact = new Contact();
			
			if($request->tenant == 'Y') {
				if(isset($request->property_id)) {
					$contact->property_id = $request->property_id;
				}
			} elseif($request->tenant == 'N') {
				$contact->property_id = NULL;
			}
			
			$contact->first_name = $request->first_name;
			$contact->last_name = $request->last_name;
			$contact->email = $request->email;
			$contact->phone = $request->phone;
			$contact->family_size = $request->family_size;
			$contact->dob = $request->dob;
			$contact->tenant = $request->tenant;
			$contact->save();
			
			return redirect('contacts')->with('status', 'Contact Added Successfully');
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
		$properties = Property::all();
		$documents = $contact->documents;
		$property = $contact->property;
        return view('contacts.edit', compact('contact', 'property', 'properties', 'documents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
		// dd($request);
        $this->validate($request, [
			'first_name' => 'required|max:30',
			'last_name' => 'required|max:30',
			'contact_image' => 'file|image',
			'contact_document' => 'file',
		]);
		
		if($request->tenant == 'Y') {
			if(isset($request->property_id)) {
				$contact->property_id = $request->property_id;
			}
		} elseif($request->tenant == 'N') {
			$contact->property_id = NULL;
		}
		
		$contact->first_name = $request->first_name;
		$contact->last_name = $request->last_name;
		$contact->email = $request->email;
		$contact->phone = $request->phone;
		$contact->family_size = $request->family_size;
		$contact->dob = $request->dob;
		$contact->tenant = $request->tenant;
		
		if($contact->save()) {
			if($request->hasFile('contact_image')) {
				$newImage = $request->file('contact_image');
				$addImage = new ContactImages();
				
				// Check to see if images is about 25MB
				// If it is then resize it
				if($newImage->getClientSize() < 25000000) {
					$image = Image::make($newImage->getRealPath())->orientate();
					$path = $newImage->store('public/images');
					$image->save(storage_path('app/'. $path));

					$addImage->path = $path;
					$addImage->contact_id = $contact->id;
					
					$addImage->save();
				} else {
					// Resize the image before storing. Will need to hash the filename first
					$path = $newImage->store('public/images');
					$image = Image::make($newImage)->orientate()->resize(1500, null, function ($constraint) {
						$constraint->aspectRatio();
						$constraint->upsize();
					});
					$image->save(storage_path('app/'. $path));

					$addImage->contact_id = $contact->id;
					
					$addImage->save();
				}
				
			}

			if($request->hasFile('document')) {
				$parentID = Files::max('id');
				foreach($request->file('document') as $document) {
					$files = new Files();
					$files->title = $request->document_title;
					$files->contact_id = $contact->id;
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
		}

		return redirect()->back()->with('status', 'Contact Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
		
		return redirect()->action('ContactController@index', $contact)->with('status', 'Contact Deleted Successfully');
    }
	
	/**
     * Restore the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
		$contact = Contact::onlyTrashed()->where('id', $id)->first();
		
		if($contact != null) {
			$contact->restore();
		}
		
		return redirect()->action('ContactController@index', $contact)->with('status', 'Contact Restored Successfully');
    }
}
