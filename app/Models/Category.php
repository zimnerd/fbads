<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
