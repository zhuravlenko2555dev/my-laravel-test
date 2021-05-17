<?php

namespace App\Listeners;

use App\Events\ApiRequestHit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;

class IncrementApiRequestHitByUser
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
     * @param  ApiRequestHit  $event
     * @return void
     */
    public function handle(ApiRequestHit $event)
    {
        if (!Cache::add('api:users:' . $event->user_id, 1)) {
            Cache::increment('api:users:' . $event->user_id);
        }
    }
}
