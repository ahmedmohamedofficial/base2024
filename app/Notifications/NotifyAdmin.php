<?php

namespace App\Notifications;

use App\Traits\FirebaseTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NotifyAdmin extends Notification
{
    use Queueable, FirebaseTrait;
    
    private $MessageData;

    public function __construct($MessageData)
    {
        $this->MessageData = $MessageData;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
		if ($notifiable->is_notify) {
			$this->sendFcmNotification($notifiable->devices() , $this->MessageData , $notifiable->lang ?? 'ar');
		}
        return $this->MessageData ;
    }
}
