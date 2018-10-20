<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'text', 'image', 'link', 'date'
    ];

    /**
     * Get the user that owns the phone.
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * Get the content that owns the phone.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the content that owns the phone.
     */
    public function likes()
    {
        return $this->belongsToMany('App\User', 'likes', 'content_id', 'user_id');
    }
}
