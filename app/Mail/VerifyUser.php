<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyUser extends Mailable {
	use Queueable, SerializesModels;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	*/
	public function __construct($username, $websiteLink, $appLink) {
		$this->username = $username;
		$this->websiteLink = $websiteLink;
		$this->appLink = $appLink;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	*/
	public function build() {
		return $this->from( config("adminlte.from_email", 'admin@whichvocation.com'), config('adminlte.whichvocation', 'Whichvocation') )
					->subject(config('adminlte.set_password', ''))
					->view('emails.verify_user')
					->with(['username' => $this->username, 'websiteLink' => $this->websiteLink, 'appLink' => $this->appLink ]);
	}
}
