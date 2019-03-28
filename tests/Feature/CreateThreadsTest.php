<?php

namespace Tests\Feature;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function guest_may_not_create_thread()
    {
        $this->expectException(AuthenticationException::class);
        $thread = factory('App\Thread')->make();

        $this->post('/threads', $thread->toArray());
    }

    /** @test */
    function an_auntheficated_user_can_create_new_forum_threads()
    {
        $this->actingAs(factory('App\User')->create());

        $thread = factory('App\Thread')->make();

        $this->post('/threads', $thread->toArray());

        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
