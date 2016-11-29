<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // category-> item
    public function items() {
      return $this->hasMany('App\Item');
    }

    // public static function getReviewRanking() {
    //   return [
    //     1 => "test",
    //     2 => "test"
    //   ];
    // }
}
