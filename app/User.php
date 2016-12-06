<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // user->reccommends
    public function reccomend() {
      return $this->hasMany('App\Reccomend');
    }
    // user->review
    public function review() {
      return $this->hasMany('App\Review');
    }
    // user->comment
    public function comment() {
      return $this->hasMany('App\Comment');
    }

}
