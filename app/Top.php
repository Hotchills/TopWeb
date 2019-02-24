<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;

class Top extends Model {

    public $table = 'tops';
    protected $fillable = [
        'page_name', 'title', 'body',
    ];

    public function page() {
        return $this->belongsTo('App\Page', 'page_id', 'id');
    }
    public function movie() {
        return $this->hasOne('App\Movie', 'top_id', 'id');
    }
    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function comments() {
        return $this->hasMany('App\Comment', 'top_id', 'id');
    }

    public function liketops() {
        return $this->hasMany('App\LikeTop', 'top_id', 'id');
    }
    
    public function upvotestop()
    {
         $likes=LikeTop::where('top_id',  $this->id)->where('liketop','1')->count();
        return $likes;
    }
        public function downvotestop()
    {
        $dislikes=LikeTop::where('top_id', $this->id)->where('liketop','2')->count();
        return $dislikes;
    }

    public function showUpVote() {        //
        $comments = Comment::where('top_id', $this->id)->where('approuved','1')->whereNull('replay_id')->orderBy('up_vote', 'desc')->take(10)->get(); //->Paginate(4, ['*'], "pageup$this->id");

        return $comments;
    }

    public function show() {        //
        $comments = Comment::where('top_id', $this->id)->where('approuved','1')->whereNull('replay_id')->orderBy('created_at')->take(10)->get(); //->Paginate(4, ['*'], "page$this->id");

        return $comments;
    }

    public function showDownVote() {        //
        $comments = Comment::where('top_id', $this->id)->where('approuved','1')->whereNull('replay_id')->orderBy('down_vote', 'desc')->take(10)->get(); //->Paginate(4, ['*'], "pagedown$this->id");
        return $comments;
    }
    
    

}
