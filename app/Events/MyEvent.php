<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MyEvent implements ShouldBroadcast
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $user_id;
    public $name;
    public $email;
    public $dead_line;
    public $title;
    public function __construct($data)
    {
        $this->user_id=$data['user_id'];
            $this->name=$data['name'];
            $this->email=$data['email'];
            $this->dead_line=$data['dead_line'];
            $this->title=$data['title'];
        //
    }
  public function broadcastOn()
  {
      return ['my-channel'];
  }

  public function broadcastAs()
  {
      return 'my-event';
  }

}
