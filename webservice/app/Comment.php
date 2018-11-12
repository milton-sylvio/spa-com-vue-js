<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content_id', 'text', 'date'
    ];

    /**
     * Get the user that owns the phone.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the content that owns the phone.
     */
    public function contents()
    {
        return $this->belongsTo('App\Content');
    }

    /**
     * Formatar a Data para PT-BR.
     */
    public function getDateAttribute($value)
    {
        return date('d/m/Y - H:i', strtotime($value));
    }
}
