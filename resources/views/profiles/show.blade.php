@extends('layouts.app')

@section('content')
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-2">

                    <h4>
                        {{ $profileUser->name }}
                        <small>Since {{ $profileUser->created_at->diffForHumans() }}</small>
                    </h4>
                    <hr>

                    @foreach ($activities as $activity)
                        @include("profiles.activities.{$activity->type}")
                    @endforeach

                    {{--{{ $threads->links() }}--}}

                </div>
            </div>
        </div>

@endsection