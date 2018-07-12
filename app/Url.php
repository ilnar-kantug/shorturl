<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    const CHAR_IN_SHORT = 5;

    protected $fillable = ['user_id', 'long', 'short', 'till'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function infos()
    {
        return $this->hasMany(Info::class);
    }
}
