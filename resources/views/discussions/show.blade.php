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
        </div>
</div>

@foreach ($discussion->replies()->paginate(3) as $reply)
<div class="card my-3">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <img src="{{Gravatar::src($reply->owner->email)}}" alt="" style="width: 40px;hieght:40px;border-radius:100%">
            <span class="owner_name">{{$reply->owner->name}}</span>
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
