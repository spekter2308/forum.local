<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThreadSubscriptionController extends Controller
{
    public function store($channelId, Thread $thread)
    {
        dd(__METHOD__);
        $thread->subscribe();
    }
}
