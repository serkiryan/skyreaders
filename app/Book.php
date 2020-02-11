<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public $timestamps = false;
    
    public function users()
    {
        return $this->belongsToMany('App\User', 'book_user', 'book_id', 'user_id')->withTimestamps(['created_at']);
    }
}
