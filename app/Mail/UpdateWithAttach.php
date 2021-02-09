<?php

namespace App\Mail;

use App\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateWithAttach extends Mailable
{
    use Queueable, SerializesModels;

    /**
	* The contact instance
	*
	* @var contact
	*/
	public $contact;
	public $attachment;
	public $subject;
	public $body;
	
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contact $contact, $attachment='', $subject='', $body='')
    {
        $this->contact = $contact;
		$this->attachment = $attachment;
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
		if($this->attachment != '' || $this->attachment != null) {
			return $this->subject($this->subject)
			->view('emails.custom_message', compact('contact', 'body'))
			->attach($this->attachment->getRealPath(), 
				[
					'as' => str_ireplace(' ', '_', $this->attachment->getClientOriginalName()),
					'mime' => $this->attachment->getMimeType(),
				]
			);
		} else {
			return $this->subject($this->subject)
			->view('emails.custom_message', compact('contact', 'body'));
		}
    }
}
