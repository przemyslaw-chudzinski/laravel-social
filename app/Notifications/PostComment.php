<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Auth;

class PostComment extends Notification
{
    use Queueable;

    private $post_id;
    private $comment_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($post_id,$comment_id)
    {
        $this->post_id = $post_id;
        $this->comment_id = $comment_id;
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
                    ->action('Notification Action', 'https://laravel.com')
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
        $url = url('/wall#post-'.$this->post_id);
        $name = Auth::user()->firstName.' '.Auth::user()->lastName;
        $user_url = url('/users'.'/'.Auth::id());
        return [
            'message' => 'Użytkownik <a href="'.$user_url.'">'.$name.'</a> skomentował Twój <a href="'.$url.'">Post</a>'
        ];
    }
}
