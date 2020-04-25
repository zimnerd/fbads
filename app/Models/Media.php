<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use SoftDeletes;
    //
    public function creative()
    {
        return $this->belongsTo(Creative::class);
    }
    public function media_type()
    {
        return $this->belongsTo(MediaType::class);
    }
}
