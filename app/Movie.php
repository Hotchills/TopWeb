<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    //
    
     public function top() {
        return $this->belongsTo('App\Top','top_id', 'id');
    }
}
