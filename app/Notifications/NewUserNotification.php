<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\user;
use App\Models\quiz;

use App\Models\assignment;



class NewUserNotification extends Notification
{
    use Queueable;
public $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$assignment,$quiz)
    {
        $this->user=$user;
        $this->assignment=$assignment;
        $this->quiz=$quiz;


        //
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'user_id'=>$this->user['id'],
            'name'=>$this->user['name'],
            'email'=>$this->user['email'],
            'dead_line'=>$this->assignment['dead_line'],
            'title'=>$this->quiz['title'],





        ];
    }
}
