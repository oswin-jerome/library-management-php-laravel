<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    

    public function cate(){
        return $this->belongsTo('App\Category', 'category');
    }
    public function auth(){
        return $this->belongsTo('App\Author', 'author');
    }

}
