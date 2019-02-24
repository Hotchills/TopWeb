<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    //
    public function user() {
        return $this->belongsTo('App\User','user_id', 'id');
    }
    public function nrtops(){
        
        
        return $nrtops;
    }
        public function nrcomments(){
        $nrtops=Comment::where('user_id',  $this->user_id)->count();
        return $nrtops;
    }
}
