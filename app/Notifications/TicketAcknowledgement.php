<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketAcknowledgement extends Notification
{
    use Queueable;
    protected $messageText, $message, $link;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($messageText, $message, $link)
    {
        $this->messageText = $messageText;
        $this->message = $message;
        $this->link = $link;
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
                ->subject('Whichvocation Ticket updates')
                ->from('admin@whichvocation.com', 'Whichvocation')
                ->cc('ashish_kumar@rvtechnologies', 'Whichvocation')
                ->line($this->message)
                ->line($this->messageText)
                ->action('View Ticket', $this->link)
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
