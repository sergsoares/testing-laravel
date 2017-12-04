<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Like;
use Auth;

class Post extends Model
{
    use Likeability;
}
