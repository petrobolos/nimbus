<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserUnbannedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * The unbanned user.
     *
     * @var \App\Models\User
     */
    protected User $user;

    /**
     * UserUnbannedNotification constructor.
     *
     * @param \App\Models\User $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array
     */
    public function via(): array
    {
        return ['mail', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail(): MailMessage
    {
        return (new MailMessage())
            ->greeting(sprintf("Your ban has been lifted on %s", config('app.name')))
            ->line('You may continue playing again.')
            ->action('For more information, click here.', url('/help'))
            ->line('Thank you.');
    }

    /**
     * Get the broadcastable representation of the notification.
     *
     * @return \Illuminate\Notifications\Messages\BroadcastMessage
     */
    public function toBroadcast(): BroadcastMessage
    {
        return new BroadcastMessage($this->toArray());
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'banned' => false,
            'until' => null,
        ];
    }
}
