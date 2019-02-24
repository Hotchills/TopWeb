<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LikeTop extends Model {

    //
    public function top() {
        return $this->belongsTo('App\Top', 'top_id', 'id');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function upvotestop() {
        $likes = LikeTop::where('top_id', $this->top_id)->where('liketop', '1')->count();
        return $likes;
    }

    public function downvotestop() {
        $dislikes = LikeTop::where('top_id', $this->top_id)->where('liketop', '2')->count();
        return $dislikes;
    }

}
