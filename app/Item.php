<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    ////データ作成時に入力を許可するカラムの指定
    protected $fillable = ['name', 'image', 'info'];

    // item->reviews
    public function review() {
      return $this->hasMany('App\Review');
    }
}
