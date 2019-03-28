@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
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
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach ($thread->replies as $reply)
                    @include('threads.reply')
                @endforeach
            </div>
        </div>


            <div class="row justify-content-center">
                <div class="col-md-8">
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
            </div>



    </div>
@endsection
