<?php

namespace App\Listeners;

use App\Events\PaymentStatusChanged;
use App\Notifications\PaymentStatusChangedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PaymentStatusChangedListener
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
    public function handle(PaymentStatusChanged $event)
    {
        $event->order->user->notify(new PaymentStatusChangedNotification($event->order));
    }
}
