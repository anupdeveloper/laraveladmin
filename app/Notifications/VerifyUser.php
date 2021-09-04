<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class VerifyUser extends Notification
{
    use Queueable;
    protected $username, $websiteLink, $appLink;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
	public function __construct($username, $websiteLink, $appLink) {
		$this->username = $username;
		$this->websiteLink = $websiteLink;
		$this->appLink = $appLink;
	}

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(config('adminlte.set_password', ''))
            ->from(config("adminlte.from_email", 'admin@whichvocation.com'), config('adminlte.whichvocation', 'Whichvocation'))
            ->cc('ashish_kumar@rvtechnologies.com')
            ->line('You have successfully registered to Which Vocation. Please click the link below to verify your account.')
            ->line(new HtmlString('<a style="font-size: 13px; " class="button button-primary" href="'.$this->websiteLink.'">Verify Account</a>'))
            // ->action('Verify Account', $this->websiteLink)
            ->action('Verify Account for Mobile Devices', $this->appLink)
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
