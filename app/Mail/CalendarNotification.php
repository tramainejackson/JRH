<?php

namespace App\Mail;

use App\PropertyShowing;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CalendarNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
	* The contact instance
	*
	* @var contact
	*/
    public $showDate;
	public $subject;
	
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($showDate="", $subject="")
    {
	    $this->showDate = new Carbon($showDate);
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
	    $showingDate = PropertyShowing::where('show_date', $this->showDate->toDateString())->get();
		
        return $this->subject($this->subject)->view('emails.calendar_notification', compact( 'setting', 'showingDate'));
    }
}
