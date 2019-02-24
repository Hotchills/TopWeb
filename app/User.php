<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends \TCG\Voyager\Models\User {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];
    protected $casts = [
        'isAdmin' => 'integer',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function isAdmin(){
        return $this->isAdmin;     
    }

    public function comments() {
        return $this->hasMany('App\Comment', 'user_id', 'id');
    }
    
        public function tops() {
        return $this->hasMany('App\Top', 'user_id', 'id');
    }

    public function likes() {
        return $this->hasMany('App\Like');
    }

    public function liketops() {
        return $this->hasMany('App\LikeTop');
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }
    public function userprofile() {
        return $this->hasOne('App\UserProfile', 'user_id', 'id');
    }
    

}
