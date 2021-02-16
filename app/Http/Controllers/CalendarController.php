<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Property;
use App\PropertyShowing;
use App\Mail\CalendarNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;

class CalendarController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth')->except(['index', 'show', 'get_showings']);
	}

	/**
	 * Get the calendar for property showings.
	 *
	 * @param  \App\Property  $property
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request, PropertyShowing $propertyShowing) {
		$showDate = Carbon::now();
		$allContacts = Contact::all();
		$allProperties = Property::all();
		$todayShowings = PropertyShowing::where('show_date', $showDate->toDateString())->get();

		return view('calendar', compact('showDate', 'todayShowings', 'allContacts', 'allProperties'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Property  $property
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$time = "";
		$timeArray = explode(':', str_ireplace(array('AM', 'PM'), '', $request->new_timepicker));

		if(substr_count($request->new_timepicker, 'PM') > 0) {
			if($timeArray[0] != 12) {
				$time = ($timeArray[0] + 12) . ':' . $timeArray[1];
			} else {
				$time = $timeArray[0] . ':' . $timeArray[1];
			}
		} else {
			if($timeArray[0] != 12) {
				$time = $timeArray[0] . ':' . $timeArray[1];
			} else {
				$time = '0:' . $timeArray[1];
			}
		}

		$showing = new PropertyShowing();
		$showing->property_id = $request->new_property_showing;
		$showing->show_date = $request->new_datetimepicker_submit == null ? Carbon::now() : $request->new_datetimepicker_submit;
		$showing->show_time = $time;
		$showing->show_instructions = $request->new_show_instructions;

		if($showing->save()) {
			return redirect()->back()->with('status', 'Showing added successfully');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Property  $property
	 * @return \Illuminate\Http\Response
	 */
	public function add_showing(Request $request, Property $property) {
		$time = "";
		$timeArray = explode(':', str_ireplace(array('AM', 'PM'), '', $request->show_time));

		if(substr_count($request->show_time, 'PM') > 0) {
			if($timeArray[0] != 12) {
				$time = ($timeArray[0] + 12) . ':' . $timeArray[1];
			} else {
				$time = $timeArray[0] . ':' . $timeArray[1];
			}
		} else {
			if($timeArray[0] != 12) {
				$time = $timeArray[0] . ':' . $timeArray[1];
			} else {
				$time = '0:' . $timeArray[1];
			}
		}

		$showing = new PropertyShowing();
		$showing->property_id = $property->id;
		$showing->show_date = $request->show_date_submit == null ? Carbon::now() : $request->show_date_submit;
		$showing->show_time = $time;
		$showing->show_instructions = $request->showing_instruc;

		if($showing->save()) {
			return redirect()->back()->with('status', 'Showing added successfully');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Property  $property
	 * @return \Illuminate\Http\Response
	 */
	public function show($date) {
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
	public function destroy(PropertyShowing $calendar) {
		if($calendar->delete()) {
			return 'Property showing deleted successfully';
		}
	}

	/**
	 * Update the specified resource from storage.
	 *
	 * @param  \App\Property  $property
	 * @return \Illuminate\Http\Response
	 */
	public function update_showing(Request $request, PropertyShowing $propertyShowing) {
		// dd($request);
		$time = "";
		$timeArray = explode(':', str_ireplace(array('AM', 'PM'), '', $request->time));

		if(substr_count($request->time, 'PM') > 0) {
			if($timeArray[0] != 12) {
				$time = ($timeArray[0] + 12) . ':' . $timeArray[1];
			} else {
				$time = $timeArray[0] . ':' . $timeArray[1];
			}
		} else {
			if($timeArray[0] != 12) {
				$time = $timeArray[0] . ':' . $timeArray[1];
			} else {
				$time = '0:' . $timeArray[1];
			}
		}

		$propertyShowing->show_date = $request->date;
		$propertyShowing->show_time = $time;
		$propertyShowing->show_instructions = $request->instructions;
		if($propertyShowing->save()) {}
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
}