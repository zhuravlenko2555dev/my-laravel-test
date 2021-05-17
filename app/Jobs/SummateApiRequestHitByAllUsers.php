<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class SummateApiRequestHitByAllUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $redis = Redis::connection('cache')->client();
        $keys = $redis->keys('*api:users:*');
        $apiRequestHitCountAllUsers = 0;
        foreach ($keys as $key) {
            $apiRequestHitCountAllUsers += Cache::get('api:users:' . last(explode(':', $key)));
        }
        Cache::put('api:all_users', $apiRequestHitCountAllUsers);
    }
}
