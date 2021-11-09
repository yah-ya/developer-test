<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Badge;
use App\Models\User;
use Illuminate\Http\Request;

class AchievementsController extends Controller
{
    public function index(User $user)
    {
        return response()->json([
            'unlocked_achievements' => !empty($user->achievements) ? $user->achievements->map(function($ach){
                return $ach->achievement->title;
            }) : [],
            'next_available_achievements' => Achievement::whereNotIn('id', !empty($user->achievements)?$user->achievements->map(function($ach){
                return $ach->id;
            }):[])->groupBy('model')->get()->map(function($ach){return $ach->title;}),
            'current_badge' => Badge::find($user->badge_id)->title,
            'next_badge' => Badge::where('id','>',$user->badge_id)->first()->title,
            'remaing_to_unlock_next_badge' => Badge::where('id','>',$user->badge_id)->get()->count()
        ]);
    }
}
