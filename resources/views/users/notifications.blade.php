@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">Notifications</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <ul class="list-group">
            @foreach ($notifications as $notification)

            <div class="list-group-item">

                @if ($notification->type === "LaravelForum\Notifications\NewReplyAdded")
                    new Reply is added to your discussion
                    <strong>{{ $notification->data['discussion']['title'] }}</strong>
                    <a href="{{ route('discussions.show',$notification->data['discussion']['slug'] ) }}" class="btn btn-sm btn-info float-right">View Discussion</a>
                @endif

            </div>

            @endforeach
        </ul>

    </div>
</div>
@endsection
