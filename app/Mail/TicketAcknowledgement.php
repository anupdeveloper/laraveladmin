<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketAcknowledgement extends Mailable {
	use Queueable, SerializesModels;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	*/
	public function __construct($userName, $messageText, $ticketLink, $userType/* , $attachedFile */) {
		$this->userName = $userName;
		$this->messageText = $messageText;
		$this->ticketLink = $ticketLink;
		$this->userType = $userType;
		// $this->attachedFile = $attachedFile;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	*/
	public function build() {
		$subject = $this->userType == 'sender' ? config('adminlte.ticket_acknowledgement_subject', 'Whichvocation Ticket Updates') : config('adminlte.ticket_acknowledgement_subject_receiver', 'Whichvocation Ticket Updates');
		// $attachedFile = $this->attachedFile;
		return $this->from( config("adminlte.from_email", 'admin@whichvocation.com'), config('adminlte.whichvocation', 'Whichvocation') )
			->subject($subject)
			->view('emails.ticket_acknowledgement')
			// ->attach($attachedFile)
			->with([
				'userName' => $this->userName,
				'messageText' => $this->messageText,
				'ticketLink' => $this->ticketLink,
				'userType' => $this->userType
			]);
	}
}