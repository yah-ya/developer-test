<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AchievementsController;

Route::get('/users/{user}/achievements', [AchievementsController::class, 'index']);

Route::post('/users/{user}/comment', function($user,\Illuminate\Http\Request $req){
    $user = \App\Models\User::findOrFail($user);

    \Illuminate\Support\Facades\DB::table('comments')->insert([
        'user_id'=>$user->id,
        'body'=>$req->body,
    ]);
    return response()->json(['res'=>true]);
});
Route::post('/users/{user}/watch/{lesson}', function($user,$lesson){

    $user = \App\Models\User::findOrFail($user);
    $lesson = \App\Models\Lesson::findOrFail($lesson);

    // did not use eloquent because you did not create models for this table
    if(!\Illuminate\Support\Facades\DB::table('lesson_user')
        ->where('user_id',$user->id)
        ->where('watched',true)
        ->where('lesson_id',$lesson->id)
        ->first()){
        \Illuminate\Support\Facades\DB::table('lesson_user')->insert([
            'user_id'=>$user->id,
            'lesson_id'=>$lesson->id,
            'watched'=>1
        ]);
    }
    \App\Events\LessonWatched::dispatch( $lesson,$user  );
    return response()->json(['res'=>true]);
});

Route::get('/users/{user}/comment', function(){
    \App\Events\CommentWritten::dispatch();
});
