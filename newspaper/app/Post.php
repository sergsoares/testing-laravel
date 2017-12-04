<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Like;
use Auth;

class Post extends Model
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


}
