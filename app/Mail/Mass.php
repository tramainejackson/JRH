<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Mass extends Mailable
{
    use Queueable, SerializesModels;

    /**
	* The contact instance
	*
	* @var contact
	*/
	public $body;
	
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($body="")
    {
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		$setting = \App\Settings::find(1);
		
        return $this->subject('Jackson Rental Homes')->view('emails.new_mass_message', compact('body', 'setting'));
    }
}
