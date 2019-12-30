<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdFormat extends Model
{
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
