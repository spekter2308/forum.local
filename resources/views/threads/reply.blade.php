<div class="card">
    <div class="card-header">
       <div class="level">

           <h6 class="flex">
               <a href="#">
                   {{ ($reply->owner->name) }}
               </a> said {{ $reply->created_at->diffForHumans() }}...
           </h6>


            <form method="POST" action="/replies/{{ $reply->id }}/favorites">
                @csrf

                <button type="submit" class="btn btn-outline-secondary {{ $reply->isFavorited() ? 'disabled' : '' }}">
                    {{ $reply->favorites()->count() }} {{ Str::plural('Favorite', $reply->favorites()->count()) }}
                </button>
            </form>

       </div>
    </div>

    <div class="card-body">
        {{ $reply->body }}
    </div>

</div>