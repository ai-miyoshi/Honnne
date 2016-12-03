<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reccomend extends Model
{
    // reccomennds->review
    public function review() {
    return $this->belongsTo('App\Review');
    }
    // reccomennds->user
    public function user() {
    return $this->belongsTo('App\User');
    }
}
