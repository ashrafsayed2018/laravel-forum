@extends('layouts.app')

@section('content')

<div class="card">
    @include('partials.discussion-header')

    <div class="card-body">
        <div class="text-center">
            <strong>
                {!! $discussion->title !!}
             </strong>
        </div>
        <hr>
        {!! $discussion->content !!}
        @if ($discussion->bestReply)
        <div class="card my-4">
            <div class="card-header bg-success" style="color: #fff">
                <div class="d-flex justify-content-between align-items-baseline">
                    <div>
                        <img src="{{ Gravatar::src($discussion->bestReply->owner->email) }}" style="width: 40px;height:40px;border-radius:50%" alt="">
                        <span class="reply-owner" style="margin-left: 1rem">{{ $discussion->bestReply->owner->name }}</span>
                    </div>
                    <div>
                       Best Reply
                    </div>
                </div>
            </div>
            <div class="card-body">
                {!! $discussion->bestReply->content !!}
            </div>
        </div>
        @endif

        </div>
</div>

@foreach ($discussion->replies()->paginate(3) as $reply)
<div class="card my-3">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div>
                <img src="{{Gravatar::src($reply->owner->email)}}" alt="" style="width: 40px;hieght:40px;border-radius:100%">
                <span class="owner_name">{{$reply->owner->name}}</span>
            </div>
            @auth
                @if (auth()->user()->id === $discussion->user_id)
                <div>
                    <form action="{{ route('discussions.best-reply',['discussion' => $discussion->slug,'reply' => $reply->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">mark as best</button>
                    </form>
                </div>
                @endif
            @endauth



        </div>
    </div>
    <div class="card-body">
        {!! $reply->content!!}
    </div>
</div>
@endforeach
{{$discussion->replies()->paginate(3)->links()}}

<div class="card"></div>
    <div class="card-header my-2">
        Add a reply
    </div>
    <div class="card-body">
       @auth
       <form action="{{route('replies.store',$discussion->slug)}}" method="POST">
            @csrf
            <input type="hidden" name="content" id="content">
            <trix-editor input="content"></trix-editor>
            <button class="btn btn-success btn-sm my-2">Add Reply</button>
        </form>
       @else
       <a href="{{route('login')}}" class="btn btn-info">Login to reply</a>
       @endauth
    </div>
</div>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css">
@endsection

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
@endsection
