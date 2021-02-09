<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Settings;
use App\Property;
use Carbon\Carbon;

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
	public function test()
	{
		dd('Test');
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
		$settings = Settings::find(1);
		$showcase_properties = Property::where([
			['showcase', '=', 'Y'],
			['active', '=', 'Y']
		])
		->limit(5)
		->get();
		$activePropCount = Property::where('active', '=', 'Y')->get()->count();
		$carouselImages = explode(';', $settings->carousel_images);

		// Update settings site counter
		$settings->hit_count++;
		if($settings->save()){}
		
        return view('welcome', compact('showcase_properties', 'ieCheck', 'activePropCount', 'carouselImages'));
    }
	
	/**
     * Show the application public welcome.
     *
     * @return \Illuminate\Http\Response
     */
    public function reset_counter()
    {
		$settings = Settings::find(1);

		// Update settings site counter
		$settings->hit_count = 0;
		$settings->hit_count_date = Carbon::now();
		
		if($settings->save()){
			
			return 'Website Hit Count Reset';
			
		}
		
    }
}