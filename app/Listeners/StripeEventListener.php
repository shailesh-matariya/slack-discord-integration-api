<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Cashier\Events\WebhookReceived;

class StripeEventListener
{
    /**
     * Handle received Stripe webhooks.
     *
     * @param WebhookReceived $event
     * @return void
     */
    public function handle(WebhookReceived $event)
    {
        \Log::debug($event->payload['type'],$event->payload);
        /*if ($event->payload['type'] === 'invoice.payment_succeeded') {
            // Handle the incoming event...
        }*/
    }
}
