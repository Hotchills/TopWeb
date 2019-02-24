<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model {

    //
    public $table = 'pages';
    protected $fillable = [
        'name', 'title', 'body', 'mainpage_id', 
    ];

    public function mainpage() {
        return $this->belongsTo('App\MainPage','mainpage_id','id');
    }

    public function tops() {
        return $this->hasMany('App\Top','page_id','id');
    }

}
