<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use Favoritable, RecordsActivity;

    /**
     * Don't auto-apply mass assigment protection.
     *
     * @var array
     */
    protected $guarded = [];

    protected $appends = ['isFavorited', 'favoritesCount'];

    protected $with = ['owner', 'favorites'];

      protected static function boot()
      {
          parent::boot();

          static::created(function ($reply) {
              $reply->thread->increment('replies_count');
          });

          static::deleted(function ($reply) {
              $reply->thread->decrement('replies_count');
          });
      }

    /**
     * A reply has owner
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    public function path()
    {
        return $this->thread->path() . "#reply-{$this->id}";
    }
}
