<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Property;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('contacts.create');
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
			$contact->family_size = $request->family_size;

			$contact->save();
			
			
			return back()->with('status', 'You Have Been Added To Our Contact Successfully');
		} else {
			$this->validate($request, [
				'first_name' => 'required|max:30',
				'last_name' => 'required|max:30',
			]);
			
			$contact = new Contact();
			
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
        return view('contacts.edit', compact('contact', 'properties'));
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
        //
    }
}
