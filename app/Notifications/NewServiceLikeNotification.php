<?php

namespace App\Notifications;

use App\Models\Service;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class NewServiceLikeNotification extends Notification
{
    use Queueable;
    private $customer;
    private $service;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $customer , Service $service)
    {
        $this->customer = $customer;
        $this->service = $service;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase()
    {

        return [
            'channel' => 'services',
            'user_id' => $this->customer->id,
            'service_id' => $this->service->id,
            'title' => Lang::get('notifications.new_service_like_title'),
        ];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
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
