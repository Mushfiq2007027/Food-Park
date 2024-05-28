<?php

namespace App\Listeners;


use App\Events\RTOrderPlacedNotificationEvent;
use App\Models\OrderPlacedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RTOrderPlacedNotificationListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(RTOrderPlacedNotificationEvent $event): void
    {
        $notification = new OrderPlacedNotification();
        $notification->message = $event->message;
        // Cast order_id to integer if it's not already.
        $notification->order_id = (int) $event->orderId;
        //$notification->order_id = $event->orderId;
        $notification->save();

    }
}
