<?php

namespace App\Providers;

use App\Events\LessonWatched;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ListenWtachedListener
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
     * @param  LessonWatched  $event
     * @return void
     */
    public function handle(LessonWatched $event)
    {
        //
    }
}
