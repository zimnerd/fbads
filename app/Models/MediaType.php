<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaType extends Model
{
    //
    public function media()
    {
        return $this->hasMany(Media::class);
    }
}
