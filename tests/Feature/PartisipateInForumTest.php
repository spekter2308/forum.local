<?php

namespace Tests\Feature;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PartisipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function unauthenticated_users_may_not_add_replies()
    {
        $this->expectException(AuthenticationException::class);

        $this->post('/threads/1/replies', []);

    }

    /** @test */
    function an_autificated_user_may_participate_in_forum_thread()
    {
        $this->be($user = factory('App\User')->create());

        $thread = factory('App\Thread')->create();
        $reply = factory('App\Reply')->create();

        $this->post($thread->path() . '/replies', $reply->toArray());

        $this->get($thread->path())
            ->assertSee($reply->body);
    }
}
