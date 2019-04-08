@extends('layouts.app')

@section('content')
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-2">

                       <h2 class="card-header">
                           {{ $profileUser->name }}
                       </h2>
                       <hr>

                       @foreach ($activities as $date => $activity)
                           <h4 class="card-header">{{ $date }}</h4>
                               @foreach ($activity as $record)
                                   @if (view()->exists("profiles.activities.{$record->type}"))
                                       @include("profiles.activities.{$record->type}", ['activity' => $record])
                                   @endif
                               @endforeach
                       @endforeach
                   </div>

                    {{--{{ $threads->links() }}--}}

                </div>
            </div>
        </div>

@endsection