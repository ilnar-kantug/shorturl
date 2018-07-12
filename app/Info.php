<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    protected $fillable = ['url_id', 'browser', 'device', 'platform', 'ip', 'location'];

    public function url()
    {
        return $this->belongsTo(Url::class, 'url_id', 'id');
    }
}
