<?php

namespace App\Mail;

use App\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Update extends Mailable
{
    use Queueable, SerializesModels;

    /**
	* The message instance
	*
	* @var message
	*/
	public $messageEmail;
	
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Message $messageEmail)
    {
        $this->messageEmail = $messageEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.new_message');
    }
}
