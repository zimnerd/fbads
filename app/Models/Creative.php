<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Creative extends Model
{
    public function campaign()
    {
        return $this->belongsTo(Campaign::class,'campaign_id');
    }
    public function status()
    {
        return $this->hasOne(Status::class);
    }
}
