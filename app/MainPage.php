<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainPage extends Model {

    public $table = 'mainpage';
    protected $fillable = [
        'name', 'title', 'body',
    ];

    public function pages() {
        return $this->hasMany('App\Page','mainpage_id','id');
    }

}
