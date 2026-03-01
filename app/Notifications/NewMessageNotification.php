<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewMessageNotification extends Notification
{
    use Queueable;

    public $senderName;
    public $messageSnippet;
    public $senderId;

    /**
     * Create a new notification instance.
     */
    public function __construct($senderName, $messageSnippet, $senderId)
    {
        $this->senderName = $senderName;
        $this->messageSnippet = $messageSnippet;
        $this->senderId = $senderId;
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
            'type' => 'new_message',
            'sender_id' => $this->senderId,
            'message' => $this->senderName . ' sent you a message: "' . \Illuminate\Support\Str::limit($this->messageSnippet, 30) . '"',
            'url' => route('messages.show', $this->senderId)
        ];
    }
}
