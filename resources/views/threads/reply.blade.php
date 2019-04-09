<div id="app">
    <reply :attributes="{{ $reply }}" inline-template>
        <div id="reply-{{ $reply->id }}" class="card" style="margin-bottom: 30px;">
            <div class="card-header">
                <div class="level">

                    <h6 class="flex">
                        <a href="{{ route('profile', $reply->owner) }}">
                            {{ ($reply->owner->name) }}
                        </a> said {{ $reply->created_at->diffForHumans() }}...
                    </h6>


                    <form method="POST" action="/replies/{{ $reply->id }}/favorites">
                        @csrf

                        <button type="submit" class="btn btn-outline-secondary" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                            {{ $reply->favorites_count }} {{ Str::plural('Favorite', $reply->favorites_count) }}
                        </button>
                    </form>

                </div>
            </div>

            <div class="card-body">

                <div v-if="editing">
                    <textarea class="form-control" v-model="body">{{ $reply->body }}</textarea>
                </div>

                <div v-else>
                    {{ $reply->body }}
                </div>
            </div>

            @can('update', $reply)
                <div class="card-footer level">
                    <button class="btn btn-primary mr" @click="editing = true">Edit</button>
                    <form method="POST" action="/replies/{{ $reply->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            @endcan
        </div>
    </reply>
</div>