<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //データ作成時に入力を許可するカラムの指定
    protected $fillable = ['title', 'body', 'score'];

    // reviews->item
    public function item() {
    return $this->belongsTo('App\Item');
    }
    // review->comment
    public function comment() {
      return $this->hasMany('App\Comment');
    }
    // reviews->reccommend
    public function recommend() {
      return $this->hasMany('App\Recommend');
    }
    // reviews->user
    public function user() {
    return $this->belongsTo('App\User');
    }

}


