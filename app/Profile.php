<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function followers(){
        return $this->belongsToMany(User::class);
    }

    public function getImageAttribute(){
        return !is_null($this->attributes['image'])? "/storage/profile/".$this->attributes['image']: '/storage/profile/default-avatar.png';
    }

    public function getThumbnail(){
        return !is_null($this->attributes['image'])? "/storage/profile/thumbnail_".$this->attributes['image']: '/storage/profile/default-avatar.png';
    }
}
