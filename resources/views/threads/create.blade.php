@extends('layouts.app')

@section('content')
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create a new thread</div>

                    <div class="card-body">

                        <form method="POST" action="/threads">
                        	@csrf

                            <div class="form-group">
                                <label for="channel_id">Choose a Channel:</label>
                                <select name="channel_id" id="channel_id"
                                        class="form-control {{ $errors->has('channel_id') ? 'is-invalid' : '' }}" required>
                                    <option value="">Choose One...</option>
                                    @foreach ($channels as $channel)
                                        <option value="{{ $channel->id }}"
                                                {{ old('channel_id') == $channel->id ? 'selected' : '' }}>{{
                                        $channel->name }}</option>
                                   @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" name="title" id="title"
                                       class="form-control  {{ $errors->has('title') ? 'is-invalid' : '' }}" value="{{ old('title') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="body">Body:</label>
                                <textarea name="body" id="body" rows="8"
                                          class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" required>
                                    {{ old('body') }}
                                </textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Publish</button>
                            </div>

                            @include('layouts.errors')
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
