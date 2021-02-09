<?php

namespace App\Mail;

use App\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RentReminder extends Mailable
{
    use Queueable, SerializesModels;

    /**
	* The contact instance
	*
	* @var contact
	*/
	public $contact;
	public $amount;
	public $subject;
	public $body;
	
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contact $contact, $amount=0, $subject='', $body='')
    {
        $this->contact = $contact;
		$this->amount = $amount;
		$this->subject = $subject;
		$this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		return $this->subject($this->subject)->view('emails.rent_reminder', compact('contact', 'body', 'amount'));
    }
}
