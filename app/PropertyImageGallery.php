<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyImageGallery extends Model
{
    protected $fillable = ['property_id', 'name', 'size'];

    public function property()
    {
        return $this->belongsTo('App\Property');
    }
}


