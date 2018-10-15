<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Property;
use App\Settings;
use App\ContactImages;
use App\Files;
use App\Mail\Update;
use App\Mail\UpdateWithAttach;
use App\Mail\NewContact;
use App\Mail\RentReminder;
use App\Mail\Mass;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

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
		$contacts = Contact::orderBy('last_name')->paginate(20);
		$allContacts = Contact::all();
		$settings = Settings::find(1);
		$deletedContacts = Contact::onlyTrashed()->nonDuplicates()->get();
		$contactsCount = Contact::all()->count();
		$duplicates = Contact::duplicates();

        return view('contacts.index', compact('contacts', 'deletedContacts', 'settings', 'contactsCount', 'duplicates', 'allContacts'));
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
			$contact->dob = new Carbon($request->dob);
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
		$tenant = $contact->property;
// dd(config('mail.host'));
        return view('contacts.edit', compact('contact', 'tenant', 'properties', 'documents'));
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
			'contact_image' => 'image',
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
		$contact->dob = new Carbon($request->dob);
		$contact->tenant = $request->tenant;
		
		if($contact->save()) {
			if($request->hasFile('contact_image')) {
				$newImage = $request->file('contact_image');
				
				if(!$contact->image) {
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
						$addImage->path = $path;
						$addImage->save();
					}
				} else {
					// Check to see if images is about 25MB
					// If it is then resize it
					if($newImage->getClientSize() < 25000000) {
						$image = Image::make($newImage->getRealPath())->orientate();
						$path = $newImage->store('public/images');
						$image->save(storage_path('app/'. $path));

						$contact->image->path = $path;
						$contact->image->save();
					} else {
						// Resize the image before storing. Will need to hash the filename first
						$path = $newImage->store('public/images');
						$image = Image::make($newImage)->orientate()->resize(1500, null, function ($constraint) {
							$constraint->aspectRatio();
							$constraint->upsize();
						});
						$image->save(storage_path('app/'. $path));

						$contact->image->path = $path;
						$contact->image->save();
					}
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
	
	/**
     * Send an email to the contact
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function send_mail(Request $request, Contact $contact)
    {
		if($contact->email == null) {
			return redirect()->back()->with('status', 'The user doesn\'t have an email address listed. Please add an email address and try again');
		} else {
			if($request->hasFile('attachment')) {
				
				$path = $request->file('attachment');
				\Mail::to($contact->email)->send(new UpdateWithAttach($contact, $path, $request->email_subject, $request->email_body));
				
			} else {

				\Mail::to($contact->email)->send(new UpdateWithAttach($contact, '', $request->email_subject, $request->email_body));

			}
			return redirect()->back()->with('status', 'Email sent successfully');
		}
	}
	
	/**
     * Send an email to the contact
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function rent_reminder(Request $request, Contact $contact)
    {
		// dd($request);
		if($contact->email == null) {
			return redirect()->back()->with('status', 'The user doesn\'t have an email address listed. Please add an email address and try again');
		} else {
			
			\Mail::to($contact->email)->send(new RentReminder($contact, $request->rent_amount, $request->email_subject, $request->email_body));
				
			return redirect()->back()->with('status', 'Rent reminder sent successfully');
		}
	}
	
	/**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function remove_as_tenant(Request $request, Contact $contact)
    {
		$contact->property_id = null;
		$contact->tenant = 'N';
		
		if($contact->save()) {
			return redirect()->back()->with('status', 'Contact removed as tenant');
		}

    }
	
	/**
     * Remove the specified resource from storage.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function mass_email(Request $request)
    {
        $sendToContacts = isset($request->send_to) ? $request->send_to : [];
        $sendBody       = $request->send_body;
        $sendSubject    = $request->send_subject;
        $sendToAll      = $request->select_all;
        $sendToArray    = [];

		if($sendToAll == 'Y') {
            $sendToArray = Contact::all()->toArray();
        } else {

            if(count($sendToContacts) > 0) {
                foreach ($sendToContacts as $sendToContact) {
                    $to = Contact::find($sendToContact);
                    $sendToArray = array_prepend($sendToArray, $to->email);
                }
            }

        }

		if(empty($sendToArray) || empty($sendSubject)) {
			return redirect()->back()->with('status', 'Email not sent. Make sure there is text in the body of the email and recipients are selected');
		} else {

			if($request->hasFile('attachment')) {
				$path = $request->file('attachment');

				\Mail::to('lorenzo@jacksonrentalhomesllc.com')
					->bcc($sendToArray)
					->send(new Mass($sendBody, $sendSubject)
					);

			} else {

				\Mail::to('lorenzo@jacksonrentalhomesllc.com')
					->bcc($sendToArray)
					->send(new Mass($sendBody, $sendSubject)
					);

			}

		}

		return redirect()->back()->with('status', 'Email sent successfully to ' . count($sendToArray) . 'contact(s)');
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
		$contacts = Contact::search($request->search);
		$settings = Settings::find(1);
		$deletedContacts = Contact::onlyTrashed()->get();
		$contactsCount = Contact::all()->count();
		$searchCriteria = $request->search;

        return view('contacts.search', compact('contacts', 'deletedContacts', 'settings', 'contactsCount', 'searchCriteria'));
    }
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function duplicates()
    {
		$contacts = Contact::duplicates();
		$settings = Settings::find(1);

        return view('contacts.duplicates', compact('contacts', 'settings'));
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function duplicate_link(Request $request, Contact $contact)
    {
		$orginalContact = Contact::find($request->original);
		
		if($contact) {
			if($orginalContact->id == $contact->id) {
				
			} else {
				$contact->duplicate = $request->link == 'link' ? 'Y' : 'N';
				
				if($contact->duplicate == 'Y') {
					if($contact->documents) {
						foreach($contact->documents as $doc) {
							$doc->contact_id = $orginalContact->id;
							
							if($doc->save()) {}
						}
					}
					
					if($contact->property) {
						$orginalContact->property_id = $contact->property->id;
						
						if($orginalContact->save()) {}
					}
					
					if($contact->save()) {
						if($contact->delete()) {}
					}
				}
			}
		}
		
		return '';
    }
}
