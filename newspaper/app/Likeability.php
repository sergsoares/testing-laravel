<?php

namespace App;

use Auth;

trait Likeability 
{

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function like()
    {
        $like = new Like(['user_id' => Auth::id()]);

        $this->likes()->save($like);
    }

    public function dislike()
    {
        $this->likes()->delete(Auth::id());
    }

    public function isLiked()
    {
        return !! $this->likes()->where('user_id' , '=', Auth::id() )->count();

    }

    public function toggle()
    {
        if($this->isLiked()) {
            return $this->dislike();
        }

        return $this->like();
    }

    public function likesCount()
    {
        return $this->likes()->count();
    }


}