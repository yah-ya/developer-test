<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Lesson;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $lessons = Lesson::factory()
            ->count(20)
            ->create();

        $comments = Comment::factory()
            ->count(20)
            ->create();

        DB::table('achivements')->insert([
            [
                'title'=>'First Lesson Watched',
                'model'=>'Lesson',
                'count'=>'1',
            ],[
                'title'=>'5 Lesson Watched',
                'model'=>'Lesson',
                'count'=>'5',
            ],[
                'title'=>'10 Lesson Watched',
                'model'=>'Lesson',
                'count'=>'10',
            ],[
                'title'=>'25 Lesson Watched',
                'model'=>'Lesson',
                'count'=>'25',
            ],[
                'title'=>'50 Lesson Watched',
                'model'=>'Lesson',
                'count'=>'50',
            ]]
        );

        DB::table('achivements')->insert([
                [
                    'title'=>'First Comment Written',
                    'model'=>'Comment',
                    'count'=>'1',
                ],[
                    'title'=>'3 Comments Written',
                    'model'=>'Comment',
                    'count'=>'3',
                ],[
                    'title'=>'5 Comments Written',
                    'model'=>'Comment',
                    'count'=>'5',
                ],[
                    'title'=>'10 Comments Written',
                    'model'=>'Comment',
                    'count'=>'10',
                ],[
                    'title'=>'20 Lesson Watched',
                    'model'=>'Comment',
                    'count'=>'20',
                ]]
        );

        DB::table('badges')->insert([
                [
                    'title'=>'Beginner',
                    'achivements_count'=>'1',
                ],[
                    'title'=>'Intermediate',
                    'achivements_count'=>'4',
                ],[
                    'title'=>'Advanced',
                    'achivements_count'=>'8',
                ],[
                    'title'=>'Master',
                    'achivements_count'=>'10',
                ]]
        );
    }
}
