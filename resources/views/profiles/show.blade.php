@extends('layouts.app')

@section('content')
        <div class="container">
            <div class="row">
                    <h4>
                        {{ $profileUser->name }}
                        <small>Since {{ $profileUser->created_at->diffForHumans() }}</small>
                    </h4>
                </div>
            <p class="border-bottom"></p>

        </div>

        @foreach ($profileUser->threads as $thread)
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
        @endforeach

@endsection