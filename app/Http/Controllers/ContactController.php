<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Property;
use App\Settings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Mail\Update;

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
				\Mail::to('lorenzodevonj@yahoo.com')->send(new Update($contact));
				
				if(isset($request->non_modal)) {
					return redirect('/')->with('status', 'You Have Been Added To Our Contact Successfully');			
				} else {
					return "<div class='modal-body'><h2>You Have Been Added To Our Contact Successfully</h2></div>";					
				}
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
        $this->validate($request, [
			'first_name' => 'required|max:30',
			'last_name' => 'required|max:30',
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
		$contact->save();

		return redirect()->action('ContactController@edit', $contact)->with('status', 'Contact Updated Successfully');
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
