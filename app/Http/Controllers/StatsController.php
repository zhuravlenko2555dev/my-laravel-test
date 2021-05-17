<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class StatsController extends Controller
{
    /**
     * Display a total number of API requests.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function stats()
    {
        return response()->json(['number' => Cache::get('api:all_users', 0)], 200);
    }

    /**
     * Display a number of API requests for specific user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function my_stats(Request $request)
    {
        return response()->json(['number' => Cache::get('api:users:' . $request->user()->id, 0)], 200);
    }
}
