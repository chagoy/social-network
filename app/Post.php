<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['content', 'user_id'];

    public $with = ['user', 'likes'];
    
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // public function profile()
    // {
    // 	return $this->hasOne(Profile::class);
    // }

    // public function posts()
    // {
    // 	return $this->hasMany(Post::class);
    // }
}
