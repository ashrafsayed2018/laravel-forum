<div class="card-header">
    <div class="d-flex justify-content-between">
        <div>
            <img src="{{Gravatar::src($discussion->user->email)}}" style="width:40px;height:40px;border-radius:100%" class="author_image">
            <span class="author_name ml-2 font-weight-bold">
              {{$discussion->user->name}}
            </span>
        </div>
        <div>
            <a href="{{route('discussions.show',$discussion->slug)}}" class="btn btn-success btn-sm">View</a>
        </div>
    </div>
</div>