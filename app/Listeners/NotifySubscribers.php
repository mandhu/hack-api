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
        try {
            $content = array(
                "en" => 'Testing Message'
            );

            $fields = array(
                'app_id' => "f36282db-c240-4226-b685-25fe5c763668",
                'included_segments' => array('All'),
                'data' => array("foo" => "bar"),
                'large_icon' =>"ic_launcher_round.png",
                'contents' => $content
            );

            $fields = json_encode($fields);
            print("\nJSON sent:\n");
            print($fields);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                'Authorization: Basic MGQ3MTIxZDUtNWQwOS00NWYyLWI4MGQtYzUwZjg0NGYyYzJk'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

            $response = curl_exec($ch);
            curl_close($ch);

            return $response;
        } catch (\Throwable $throwable) {
            Log::error($throwable->getMessage());
        }

    }

//    MGQ3MTIxZDUtNWQwOS00NWYyLWI4MGQtYzUwZjg0NGYyYzJk


//  f36282db-c240-4226-b685-25fe5c763668
}
