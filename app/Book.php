<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;
    
    protected $casts = [
        'authors' => 'array'
    ];
    

    public function cate(){
        return $this->belongsTo('App\Category', 'category');
    }
    // public function auth(){
    //     return $this->belongsTo('App\Author', 'authors');
    // }

    public function author()
    {
        
        return $this->belongsToJson('App\Author', 'authors');
    }

}
