<?php

namespace App\Notifications;

use App\Http\Resources\ReplyResource;
use App\Models\Reply;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NewReplyNotification extends Notification
{
    use Queueable;

    public $reply;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
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
            'replier' => $this->reply->user->name,
            'question' => Str::limit($this->reply->question->title, 20),
            'path' => $this->reply->question->path,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'replier' => $this->reply->user->name,
            'question' => Str::limit($this->reply->question->title, 20),
            'path' => $this->reply->question->path,
            'reply' => new ReplyResource($this->reply),
        ]);
    }
}
