<?php

namespace App\Listeners;

use App\Events\NowInStockEvent;
use App\Models\User;
use App\Notifications\ImportantStockUpdateNotification;

class SendStockUpdateNotificationListener
{
    public function handle(NowInStockEvent $event): void
    {
        User::first()->notify(new ImportantStockUpdateNotification($event->stock));
    }
}
