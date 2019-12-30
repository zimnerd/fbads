<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Creative extends Model
{
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
    public function status()
    {
        return $this->hasOne(Status::class);
    }
}
