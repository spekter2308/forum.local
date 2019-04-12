<?php

namespace App\Http\Controllers;

use App\Filters\ReplyFilters;
use App\Reply;
use App\Thread;
use App\User;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReplyController extends Controller
{
    /**
     * Create a new RepliesController instance
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    public function index($channelId, Thread $thread)
    {
        return $thread->replies()->paginate(20);
    }

    /**
     * @param $channelId
     * @param Thread $thread
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($channelId, Thread $thread)
    {
        $this->validate(\request(), ['body' => 'required']);

        $reply = $thread->addReply([
            'user_id' => auth()->id(),
            'body' => \request('body'),
        ]);

        if (\request()->expectsJson()) {
            return $reply->load('owner');
        }

        return back()->with('flash', 'Your reply has been left');
    }

    /**
     * @param Reply $reply
     */
    public function update(Reply $reply)
    {
        $this->authorize('update', $reply);

        $reply->update(\request(['body']));
    }

    /**
     * @param Reply $reply
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Reply $reply)
    {
        $this->authorize('update', $reply);

        $reply->delete();

        if(\request()->expectsJson()) {
            return \response(['status' => 'Reply deleted']);
        }

        return back();
    }

}
