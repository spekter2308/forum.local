<?php

namespace App;

use function foo\func;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use RecordsActivity;

    /**
     * Don't auto-apply mass assigment protection.
     *
     * @var array
     */
    protected $guarded = [];
    protected $with = ['creator', 'channel'];

    protected static function boot()
    {
        parent::boot();

        /*static::addGlobalScope('replyCount', function ($builder) {
            $builder->withCount('replies');
        });*/

        static::deleting(function ($thread) {
            $thread->replies->each->delete();
        });
    }


    /**
     * A full uri to the thread
     *
     * @return string
     */
    public function path()
	{
		return "/threads/{$this->channel->slug}/{$this->id}";
	}

    /**
     * A thread has replies
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

     /**
     * A thread belong to a creator
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * A thread belong to a channel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    /**
     * Add a reply to the thread
     *
     * @param array $reply
     * @return Reply
     */
    public function addReply($reply)
    {
        return $this->replies()->create($reply);
    }

    /**
     * @param $query
     * @param $filters
     * @return mixed
     */
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function subscribe($userId = null)
    {
        $this->subscriptions()
            ->create(['user_id' => $userId ?: auth()->id()]);
    }

    public function unsubscribe($userId = null)
    {
        $this->subscriptions()
            ->where('user_id', $userId ?: auth()->id())
            ->delete();
    }

    public function subscriptions()
    {
        $this->hasMany(ThreadSubscription::class);
    }
}
