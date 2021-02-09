<?php

namespace LaravelForum;

use LaravelForum\User;
use LaravelForum\Discussion;


class Reply extends Model
{

    // the relationship with user
    public function owner() {
        return $this->belongsTo(User::class,'user_id');
    }

    // the relationship with discussion

    public function discussion() {
        return $this->belongsTo(Discussion::class);
    }
}
