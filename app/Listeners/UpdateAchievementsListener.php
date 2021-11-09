<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use App\Models\Achievement;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class UpdateAchievementsListener
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
        if($event->type=='Comment'){
            $totalAchieved = $event->user->comments()->count();
        }

        if($event->type=='Lesson'){
            $totalAchieved = $event->user->watched()->count();
        }

        $achievement = Achievement::where('count','=',$totalAchieved)->where('model',$event->type)->first();
        if(!$achievement)
            return;
        if(!DB::table('user_achivements')->where('user_id',$event->user->id)->where('achivement_id',$achievement->id)->first()) {
                DB::table('user_achivements')->insert([
                'achivement_id' => $achievement->id,
                'user_id'=>$event->user->id,
            ]);

            AchievementUnlocked::dispatch($achievement,$event->user);
        }
    }
}
