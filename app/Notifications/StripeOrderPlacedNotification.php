<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class StripeOrderPlacedNotification extends Notification
{
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Thank you for placing your order using Stripe!')
            ->line('Your order details:')
            ->line('Order ID: ' . $notifiable->id)
            ->line('Total Amount: ' . $notifiable->total_amount)
            ->action('View Order', route('my_orders', $notifiable->id))
            ->line('We will notify you once your order is processed and shipped.');
    }
    public function toArray($notifiable)
    {
        return [
            // Additional array representation of the notification
        ];
    }

    // This method is required for the notification to be sent via mail
    public function via($notifiable)
    {
        return ['mail'];
    }
}
