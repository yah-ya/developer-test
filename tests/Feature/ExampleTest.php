<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Lesson;
use Faker\Provider\en_US\Text;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $user = User::factory()->create();

        $response = $this->get("/users/{$user->id}/achievements");

        $response->assertStatus(200);
    }

    public function test_new_comment(){
        $user = User::inRandomOrder()->first();

        $response = $this->post("/users/{$user->id}/comment",
        ['body'=> \Faker\Provider\Text::regexify('[A-Za-z0-9]{20}')]);

        $response->assertStatus(200);


    }

    public function test_watch_lesson(){
        $user = User::inRandomOrder()->first();
        $lesson = Lesson::inRandomOrder()->first();

        $response = $this->post("/users/{$user->id}/watch/{$lesson->id}");

        $response->assertStatus(200);

    }
}
