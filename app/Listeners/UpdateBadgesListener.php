<?php

namespace App\Listeners;

use App\Events\BadgeUnlocked;
use App\Models\Achievement;
use App\Models\Badge;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateBadgesListener
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if($badge = Badge::where('achivements_count',$event->user->achievements->count())->first()){
            $event->user->badge_id = $badge->id;
            $event->user->save();
            BadgeUnlocked::dispatch($badge,$event->user);
        }


    }
}
