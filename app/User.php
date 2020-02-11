<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;
    
    public function books()
    {
        return $this->belongsToMany('App\Book', 'book_user', 'user_id', 'book_id')->withTimestamps(['created_at']);
    }
}
