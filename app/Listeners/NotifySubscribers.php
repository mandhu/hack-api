<?php

namespace App\Listeners;

use App\Events\NewListing;
use GuzzleHttp\Client;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

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
                'app_id' => "f36282db-c240-4226-b685-25fe5c763668",
                'included_segments' => array(
                    'All'
                ),
                'data' => json_encode([
                    'listing' => $listing
                ]),
                'contents' => []
            ],
            'headers' => [
                'Content-Type' => 'application/json; charset=utf-8',
                'Authorization' => 'Basic MGQ3MTIxZDUtNWQwOS00NWYyLWI4MGQtYzUwZjg0NGYyYzJk',
            ]
        ];

        $client = new Client();
        try {
            $client->post('https://onesignal.com/api/v1/notifications', $options);
        } catch (\Throwable $throwable) {
            Log::error($throwable->getMessage());
        }

    }
}
