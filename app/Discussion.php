<?php

namespace LaravelForum;

use LaravelForum\User;
use LaravelForum\Reply;


class Discussion extends Model
{


    // relationship between the user and the discussion

    public function author() {
        return $this->belongsTo(User::class,'user_id');
    }

    // relationship with replies

    public function replies() {
        return $this->hasMany(Reply::class);
    }
    // method to override the id in route binding by the slug we use the slug as primary key

    public function getRouteKeyName() {
        return 'slug';
    }

    // method to check if the discussion has best reply

    public function bestReply() {
        return $this->belongsTo(Reply::class,'reply_id');
    }

    public function markAsBestReply(Reply $reply) {

        $this->update([
            'reply_id' => $reply->id
        ]);

        return redirect()->back();
    }
}
