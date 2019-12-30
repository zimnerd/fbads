<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdFormat extends Model
{
    public function campaign()
    {
        return $this->hasMany(Campaign::class);
    }
}
