<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['album_id','image','size','type','link'];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
