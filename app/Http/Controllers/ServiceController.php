<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services;

class ServiceController extends Controller
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
		$services = Services::all();

		return view('services.index', compact('services'));
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
			'type'          => 'required|max:30',
			'description'   => 'required',
		]);

		$service = new Services();
		$service->type = $request->type;
		$service->description = $request->description;

		if($service->save()) {
			return redirect()->back()->with('status', 'New Service Added Successfully');
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request)
	{
		$this->validate($request, [
			'type'          => 'required|max:30',
			'description'   => 'required',
		]);

		$service = new Services();
		$service->type = $request->type;
		$service->description = $request->description;

		if($service->save()) {
			return redirect()->back()->with('status', 'New Service Added Successfully');
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request)
	{
		$this->validate($request, [
			'type'          => 'required|max:30',
			'description'   => 'required',
		]);

		$service = new Services();
		$service->type = $request->type;
		$service->description = $request->description;

		if($service->save()) {
			return redirect()->back()->with('status', 'New Service Added Successfully');
		}
	}
}
