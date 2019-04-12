<?php

namespace App\Http\Controllers;

use App\Remodling;
use App\Contact;
use App\Property;
use App\Settings;
use App\Services;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Mail\Update;
use App\Mail\NewContact;

class RemodlingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
	    return view('remodel.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Remodling  $remodling
     * @return \Illuminate\Http\Response
     */
    public function show(Remodling $remodling)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Remodling  $remodling
     * @return \Illuminate\Http\Response
     */
    public function edit(Remodling $remodling)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Remodling  $remodling
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Remodling $remodling)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Remodling  $remodling
     * @return \Illuminate\Http\Response
     */
    public function destroy(Remodling $remodling)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Remodling  $remodling
     * @return \Illuminate\Http\Response
     */
    public function services(Remodling $remodling)
    {
    	$services = Services::all();

	    return view('remodel.services', compact('services'));
    }
}
