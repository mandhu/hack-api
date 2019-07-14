<?php

namespace App\Listeners;

use App\Events\NewListing;
use GuzzleHttp\Client;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifySubscribers
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewListing  $event
     * @return void
     */
    public function handle(NewListing $event)
    {
        $listing = $event->listing;
        $options = [
            'body' => [
                'listing' => $listing
            ],
            'headers' => [
                '' => '',
                '' => '',
            ]
        ];

        $client = new Client();
        $client->post('https://onesignal.com/api/v1/notifications', $options);
    }
}
