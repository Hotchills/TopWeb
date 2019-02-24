<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\User');
    }
        public function comment()
    {
        return $this->belongsTo('App\Comment', 'comment_id', 'id');
    }
    public function upvotescomment()
    {
         $likes=Like::where('comment_id',  $this->comment_id)->where('like','1')->count();
        return $likes;
    }
        public function downvotescomment()
    {
        $dislikes=Like::where('comment_id', $this->comment_id)->where('like','2')->count();
        return $dislikes;
    }
}
