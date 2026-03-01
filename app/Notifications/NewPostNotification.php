<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewPostNotification extends Notification
{
    use Queueable;

    public $creatorName;
    public $postTitle;

    /**
     * Create a new notification instance.
     */
    public function __construct($creatorName, $postTitle)
    {
        $this->creatorName = $creatorName;
        $this->postTitle = $postTitle;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'new_post',
            'message' => $this->creatorName . ' published a new post: "' . \Illuminate\Support\Str::limit($this->postTitle, 30) . '"',
            'url' => route('dashboard')
        ];
    }
}
