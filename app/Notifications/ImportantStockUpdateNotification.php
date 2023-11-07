<?php

namespace App\Notifications;

use App\Models\Stock;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ImportantStockUpdateNotification extends Notification
{
    protected Stock $stock;

    public function __construct(Stock $stock)
    {
        $this->stock = $stock;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Important Stock Update for ' . $this->stock->product->name)
            ->line('We have an important update to the product you have been tracking.')
            ->action('Buy It Now', url($this->stock->url))
            ->line('Go get it!');
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
