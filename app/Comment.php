<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id', 
        'body', 
        'parent', 
        'parent_id', 
        'approved', 
        'commentable_id', 
        'commentable_type'
    ];

    public function commentable()
    {
        return $this->morphTo();
    }

    function users()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function children()
    {
        return $this->hasMany('App\Comment', 'parent_id', 'id');
    }
}
