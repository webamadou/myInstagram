<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getImageAttribute(){
        return '/storage/posts/'.$this->attributes['image'];
    }

    public function thumbnail(){
        return '/storage/posts/thumbnail_'.$this->attributes['image'];
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

}
