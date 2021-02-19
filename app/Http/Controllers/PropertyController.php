<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Property;
use App\PropertyImages;
use App\PropertyVideos;
use App\PropertyShowing;
use App\PropertyRequirement;
use App\Settings;
use App\Mail\Update;
use App\Mail\UpdateWithAttach;
use App\Mail\NewContact;
use App\Mail\RentReminder;
use App\Mail\Mass;
use App\Mail\CalendarNotification;
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
	public function __construct() {
		$this->middleware('auth')->except(['index', 'show', 'calendar', 'get_showings']);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {
		$totalProperties = Property::all();
		$properties = Property::paginate(12);
		$deletedProps = Property::onlyTrashed()->get();

		if($request->query('sale') !== null) {
			if($request->query('sale') == 'sale') {
				$totalProperties = Property::forSale();
			} elseif($request->query('sale') == 'rent') {
				$totalProperties = Property::forRent();
			}
		} else {

		}

		return view('properties.index', compact('properties', 'deletedProps', 'totalProperties'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$states = DB::select('select * from states');

		return view('properties.create', compact('states'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$this->validate($request, [
			'address' => 'required|max:150',
			'city' => 'required|max:100',
			'zip' => 'required|max:10',
			'description' => 'required|max:500',
			'price' => 'required',
			'bed' => 'required|min:1',
			'bath' => 'required|min:1',
		]);

		$property = new Property();

		$property->bed = $request->bed;
		$property->bath = $request->bath;
		$property->address = $request->address;
		$property->city = $request->city;
		$property->state = $request->state;
		$property->zip = $request->zip;
		$property->description = $request->description;
		$property->price = $request->price;
		$property->sale = $request->sale;
		$property->available_date = new Carbon($request->available_date);
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
	public function show(Property $property, Request $request) {
		$heroImage = $property->medias();
		$images = $property->medias;

		return view('properties.show', compact('property', 'images', 'heroImage'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Property  $property
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Property $property) {
		$states = DB::select('select * from states');
		$tenant = $property->tenant;
		$upcomingShowings = $property->showings()->whereBetween('show_date', [Carbon::today(), Carbon::now()->addWeeks(2)])
			->orderBy('show_date', 'asc')
			->get();
		$allShowings = $property->showings;
		$startDate = new Carbon($property->available_date);

		return view('properties.edit', compact('property', 'allShowings', 'upcomingShowings', 'states', 'tenant', 'startDate'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Property  $property
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Property $property) {
		// dd($request);
		$this->validate($request, [
			'address' => 'required|max:150',
			'city' => 'required|max:100',
			'zip' => 'required|max:10',
			'description' => 'required|max:500',
			'price' => 'required',
			'bed' => 'required|min:1',
			'bath' => 'required|min:1',
		]);

		$error = "";
		$property->bed = $request->bed;
		$property->bath = $request->bath;
		$property->address = $request->address;
		$property->city = $request->city;
		$property->state = $request->state;
		$property->zip = $request->zip;
		$property->description = $request->description;
		$property->price = $request->price;
		$property->available_date = new Carbon($request->available_date);
		$property->type = $request->type;
		$property->sale = $request->sale;
		$property->included_utl = isset($request->included_utl) ? implode('; ', $request->included_utl) : null;
		$property->move_in_cost = $request->move_in_price;
		$property->active = $request->active;
		$property->showcase = $request->showcase;
		$property->construction = $request->construction;

		if(isset($request->requirement_id)) {
			foreach($request->requirement_id as $key => $requirement_id) {
				$prop_requirement = $property->requirements->find($requirement_id);
				$prop_requirement->instructions = $request->update_requirements[$key];
				if($prop_requirement->save()){}
			}
		}

		if(count($request->requirements) > 1) {
			foreach($request->requirements as $requirement) {
				// Only add it if its not null
				if($requirement != null) {
					$addRequirement = new PropertyRequirement();
					$addRequirement->instructions = $requirement;
					$addRequirement->property_id = $property->id;
					if($addRequirement->save()){}
				}
			}
		}

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

							if($image->save(storage_path('app/'. $path))) {
								// prevent possible upsizing
								// Create a larger version of the image
								// and save to large image folder
								$image->resize(1500, null, function ($constraint) {
									$constraint->aspectRatio();
									// $constraint->upsize();
								});

								if($image->save(storage_path('app/'. str_ireplace('images', 'images/lg', $path)))) {
									// Get the height of the current large image
									$addImage->lg_height = $image->height();

									// Create a smaller version of the image
									// and save to large image folder
									$image->resize(500, null, function ($constraint) {
										$constraint->aspectRatio();
									});

									if($image->save(storage_path('app/'. str_ireplace('images', 'images/sm', $path)))) {
										// Get the height of the current small image
										$addImage->sm_height = $image->height();
									}
								}
							}

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
	public function destroy(Property $property) {
		// Delete Property
		if($property->delete()) {

			// Delete associated images
			if($property->medias->isNotEmpty()) {

				foreach($property->medias as $image) {

					if($image->delete()) {
						Storage::delete($image->path);
						Storage::delete(str_ireplace('images', 'images/lg', $image->path));
						Storage::delete(str_ireplace('images', 'images/sm', $image->path));
					}
				}
			}

			// Delete associated images
			if($property->videos->isNotEmpty()) {

				foreach($property->videos as $video) {

					if($video->delete()) {
						Storage::delete($video->path);
					}
				}
			}

			// Delete associated documents
			if($property->documents->isNotEmpty()) {

				foreach($property->documents as $document) {

					if($document->delete()) {
						Storage::delete($document->path);
					}
				}
			}

			// Delete associated showings
			if($property->showings->isNotEmpty()) {
				foreach($property->showings as $showing) {

					if($showing->delete()) {}
				}
			}

			// Delete associated requirements
			if($property->requirements->isNotEmpty()) {
				foreach($property->requirements as $requirement) {

					if($requirement->delete()) {}
				}
			}

			// Delete associated tenants
			if($property->tenant) {
				$property->tenant->tenant = 'N';
				$property->tenant->property_id = NULL;

				if($property->tenant->save()) {}
			}
		}

		return redirect()->action('PropertyController@index')->with('status', 'Property Deleted Successfully');
	}

	/**
	 * Restore the specified resource from storage.
	 *
	 * @param  \App\Property  $property
	 * @return \Illuminate\Http\Response
	 */
	public function restore($id) {
		$property = Property::onlyTrashed()->where('id', $id)->first();

		if($property != null) {
			$property->restore();
		}

		return redirect()->action('PropertyController@index', $property)->with('status', 'Property Restored Successfully');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Property  $property
	 * @return \Illuminate\Http\Response
	 */
	public function remove_tenant(Request $request, Property $property) {
		$contact = $property->tenant;
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
	public function get_showings($date) {
		$showDate = new Carbon($date);
		$showings = PropertyShowing::where('show_date', $date)->get();

		return view('properties.showings', compact('showings', 'showDate'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Property  $property
	 * @return \Illuminate\Http\Response
	 */
	public function calendar_notification(Request $request) {
		$sendToContacts = isset($request->send_to) ? $request->send_to : [];
		$sendDate       = $request->showing_date;
		$sendSubject    = 'Upcoming Showings';
		$sendToAll      = $request->all_contacts;
		$sendToArray    = [];

		if($sendToAll == 'Y') {
			$sendToArray = Contact::all()->toArray();
		} else {

			if(count($sendToContacts) > 0) {
				foreach ($sendToContacts as $sendToContact) {
					$to = Contact::find($sendToContact);
					$sendToArray = array_prepend($sendToArray, $to->email);
				}
			} else {}

		}

		if(empty($sendToArray)) {
			return redirect()->back()->with('status', 'Email not sent. Make sure there are recipients selected or the send to all contacts is selected');
		} else {

			\Mail::to('lorenzo@jacksonrentalhomesllc.com')
				->bcc($sendToArray)
				->send(new CalendarNotification($sendDate, $sendSubject)
				);

		}

		return redirect()->back()->with('status', 'Email sent successfully to ' . count($sendToArray) . ' contact(s)');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function search(Request $request) {
		$properties = Property::search($request->search);
		$deletedProperties = Property::onlyTrashed()->get();
		$propertiesCount = Property::all()->count();
		$searchCriteria = $request->search;

		return view('properties.search', compact('properties', 'deletedProperties', 'propertiesCount', 'searchCriteria'));
	}
}