<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Mass extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
	* The contact instance
	*
	* @var contact
	*/
	public $body;
	public $subject;
	
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($body="", $subject="")
    {
        $this->body = $body;
        $this->subject = $subject != '' ? $subject : 'Jackson Rental Homes';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		$setting = \App\Settings::find(1);
		
        return $this->subject($this->subject)->view('emails.new_mass_message', compact('body', 'setting'));
    }
}
