<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Settings;
use App\Property;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'web'])->except('welcome');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
	
	/**
     * Show the application public welcome.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome(Request $request)
    {
		$prevSession = $request->hasPreviousSession();
		$setting = Settings::find(1);
		$showcase_properties = Property::where([
			['showcase', '=', 'Y'],
			['active', '=', 'Y']
		])
		->limit(3)
		->get();

        return view('welcome', compact('setting', 'showcase_properties', 'prevSession', 'ieCheck'));
    }
}
