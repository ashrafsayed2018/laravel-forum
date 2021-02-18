<?php

namespace LaravelForum;

use LaravelForum\Notifications\ReplyMarkedAsBestReply;
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

    // method to filter by channel

    public function scopeFilterByChannels($builder) {

        if(request()->query('channel')) {

            $channel = Channel::where('slug', request()->query('channel'))->first();

            // check if there is a channel

            if($channel) {

                return $builder->where('channel_id', $channel->id);
            }

            return $builder;
        }

        return $builder;
    }
    public function markAsBestReply(Reply $reply) {

        $this->update([
            'reply_id' => $reply->id
        ]);

        if($reply->owner->id !== $this->author->id) {

            $reply->owner->notify(new ReplyMarkedAsBestReply($reply->discussion));
        }


        return redirect()->back();
    }
}
