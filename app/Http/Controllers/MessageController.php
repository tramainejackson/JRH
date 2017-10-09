<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Mail\Update;

class MessageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$this->validate(request(), [
			'name' => 'required',
			'email' => 'required|email',
			'message' => 'required'
		]);
		
		$messageEmail = new Message;
		
		$messageEmail->name = $request->name;
		$messageEmail->email = $request->email;
		$messageEmail->message = $request->message;

		$messageEmail->save();
		
		\Mail::to($messageEmail)
			->cc('adc0426@gmail.com')
			->send(new Update($messageEmail));
		
		return redirect('/')->with('status', 'Thanks for reaching out. We got your message and will get back to you once one of us checks our email.');
    }
}
