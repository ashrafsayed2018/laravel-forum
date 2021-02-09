<?php

namespace LaravelForum;

use LaravelForum\User;
use LaravelForum\Reply;


class Discussion extends Model
{


    // relationship between the user and the discussion

    public function user() {
        return $this->belongsTo(User::class);
    }

    // relationship with replies

    public function replies() {
        return $this->hasMany(Reply::class);
    }
    // method to override the id in route binding by the slug we use the slug as primary key

    public function getRouteKeyName() {
        return 'slug';
    }
}
