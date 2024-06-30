<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegisterSuccessful extends Notification
{
    use Queueable;
	// protected $surname;
	// protected $first_name;
	// protected $last_name;
	protected $username;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    // public function __construct($surname, $first_name, $last_name, $username)
    public function __construct($username)
    {
        // $this->surname = $surname;
		// $this->first_name = $first_name;
		// $this->last_name = $last_name;
		$this->username = $username;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
		// $url = url('/home');
        return (new MailMessage)
                    /* ->subject('Welcome ' . $this->username)
					->greeting('Hello ' . $this->username)
					->line('Your account has been created successfully on Worklx ERP')
					->action('View dashboard', url('/home'))
					->line('Thank you for using our application for managing your business!');
					*/
					/* ->subject(trans('registernotif.welcome', ['username' => $this->username]))
					->greeting(trans('registernotif.greeting', ['username' => $this->username]))
					->line(trans('registernotif.line'))
					->action(trans('registernotif.action'), url('/home'))
					->line(trans('registernotif.thank_you')); */
					
					->subject(__('registernotif.welcome', ['username' => $this->username]))
					->greeting(__('registernotif.greeting', ['username' => $this->username]))
					->line(__('registernotif.line'))
					->action(__('registernotif.action'), url('/home'))
					->line(__('registernotif.thank_you'));

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
            'data' => 'Your account has been created successfully on Worklx ERP'
        ];
    }
}
