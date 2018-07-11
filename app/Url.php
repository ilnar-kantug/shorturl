<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $fillable = ['user_id', 'long', 'short', 'till'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
