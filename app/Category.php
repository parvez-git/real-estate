<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','slug','image'];


    public function posts()
    {
        return $this->belongsToMany(Post::class)->withTimestamps();
    }
}
