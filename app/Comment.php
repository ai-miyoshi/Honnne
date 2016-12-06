<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // review->comments
    public function review() {
    return $this->belongsTo('App\Review');
  }
    // user->comments
    public function user() {
    return $this->belongsTo('App\User');
    }
}
