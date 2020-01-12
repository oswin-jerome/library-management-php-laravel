<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // public function department(){
    //     return $this->belongsTo('App\Department', 'dept');
    // }

    public function member(){
        return $this->belongsTo('App\Member', 'member_id');
    }

    public function book(){
        return $this->belongsTo('App\Book', 'book_id');
    }
}
