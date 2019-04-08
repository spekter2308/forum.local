<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReplyController extends Controller
{
    /**
     * Create a new RepliesController instance
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param $channelId
     * @param Thread $thread
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($channelId, Thread $thread)
    {
        $this->validate(\request(), ['body' => 'required']);

        $thread->addReply([
            'user_id' => auth()->id(),
            'body' => \request('body'),
        ]);

        return back()->with('flash', 'Your reply has been left');
    }
}
