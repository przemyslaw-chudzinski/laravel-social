<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Auth;

class Liked extends Notification
{
    use Queueable;

    private $object;

    private $type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($object,$type)
    {
        $this->object = $object;
        $this->type = $type;
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
        $message = "";

        $name = Auth::user()->firstName.' '.Auth::user()->lastName;
        $user_url = url('/users'.'/'.Auth::id());
        // if($this->type === 'comment')
        // {
        //   $url = ""; //TODO
        //   $message = "Użytkownik <a href='".$user_url."'>".$name."</a> polubił Twój komentarz w  <a href='".$url."'>poście</a>";
        // }
        if($this->type === 'post'){
          $url = url('/wall#post-'.$this->object->id);
          $message = "Użytkownik <a href='".$user_url."'>".$name."</a> polubił Twój <a href='".$url."'>post</a>";
        }//dd($this->object);
        return [
            'message' => $message
        ];
    }
}
