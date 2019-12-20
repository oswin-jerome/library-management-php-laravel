<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //

    public function department(){
        return $this->belongsTo('App\Department', 'dept');
    }
}
