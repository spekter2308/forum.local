@extends('layouts.app')

@section('content')
    @php
    	/** @var \App\Thread $thread */
    @endphp

    <thread-view :initial-replies-count="{{ $thread->replies_count }}" inline-template>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card" style="margin-bottom: 20px;">
                        <div class="card-header">
                            <div class="level">
                                <span class="flex">
                                     <a href="{{ route('profile', $thread->creator) }}">
                                         {{ $thread->creator->name }}
                                    </a> posted:
                                    {{ $thread->title }}
                                </span>

                               @can('update', $thread)
                                    <form method="POST" action="{{ $thread->path() }}">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn-link btn" type="submit">Delete Thread</button>
                                    </form>
                               @endcan
                            </div>


                        </div>

                        <div class="card-body">
                            {{ $thread->body }}
                        </div>
                    </div>

                    <replies @added="repliesCount++"
                             @removed="repliesCount--">
                    </replies>

                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            This thread was published {{ $thread->created_at->diffForHumans() }} by
                            <a href="#">{{ $thread->creator->name }}</a>, and currently has <span
                                    v-text="repliesCount"></span>
                            {{ Str::plural('comment', $thread->replies_count) }}.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </thread-view>
@endsection
