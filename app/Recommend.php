<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recommend extends Model
{
    // recommends->review
    public function review() {
    return $this->belongsTo('App\Review');
    }
    // recommends->user
    public function user() {
    return $this->belongsTo('App\User');
    }
}
