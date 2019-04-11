<reply :attributes="{{ $reply }}" inline-template v-cloak>
    <div id="reply-{{ $reply->id }}" class="card" style="margin-bottom: 30px;">
        <div class="card-header">
            <div class="level">

                <h6 class="flex">
                    <a href="{{ route('profile', $reply->owner) }}">
                        {{ ($reply->owner->name) }}
                    </a> said {{ $reply->created_at->diffForHumans() }}...
                </h6>

                <div>
                    <favorite :reply="{{ $reply }}"></favorite>

                    {{--<form method="POST" action="/replies/{{ $reply->id }}/favorites">--}}
                        {{--@csrf--}}

                        {{--<button type="submit" class="btn btn-outline-secondary" {{ $reply->isFavorited() ? 'disabled' : '' }}>--}}
                            {{--{{ $reply->favorites_count }} {{ Str::plural('Favorite', $reply->favorites_count) }}--}}
                        {{--</button>--}}
                    {{--</form>--}}
                </div>

            </div>
        </div>

        <div class="card-body">

            <div v-if="editing">
                <div class="form-group">
                    <textarea class="form-control" v-model="body"></textarea>
                </div>

                <button class="btn btn-primary" @click="update">Update</button>
                <button class="btn btn-link" @click="cancel">Cancel</button>
            </div>

            <div v-else v-text="body"></div>
        </div>

        @can('update', $reply)
            <div class="card-footer level">
                <button class="btn btn-primary mr" @click="editing = true">Edit</button>
                <button class="btn btn-danger mr" @click="destroy">Delete</button>
            </div>
        @endcan
    </div>
</reply>