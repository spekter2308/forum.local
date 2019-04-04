@extends('layouts.app')

@section('content')
    @php
    	/** @var \App\Thread $thread */
    @endphp
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card" style="margin-bottom: 20px;">
                    <div class="card-header">
                        <a href="#">
                            {{ $thread->creator->name }}
                        </a> posted:
                        {{ $thread->title }}
                    </div>

                    <div class="card-body">
                        {{ $thread->body }}
                    </div>
                </div>
                
                @foreach ($replies as $reply)
                    @include('threads.reply')
                @endforeach

                {{ $replies->links() }}

                @if (auth()->check())
                <form method="POST" action="{{ $thread->path() . '/replies' }}">
                    @csrf
                    <div class="form-group">
                        <label for="body">Body:</label>
                        <textarea name="body" id="body" class="form-control" placeholder="Have something to say?"
                        rows="5"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Post</button>
                </form>
                @else
                    <p class="text-center">Please <a href="{{ route('login') }}">sing in</a> to partisipate this
                        disscussion</p>
                @endif

            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        This thread was published {{ $thread->created_at->diffForHumans() }} by
                        <a href="#">{{ $thread->creator->name }}</a>, and currently has {{ $thread->replies_count
                        }} {{ Str::plural('comment', $thread->replies_count) }}.
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
