<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{

    use SoftDeletes;
    protected $table = 'campaigns';

    /**
     * Get the User that owns the Notes.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id')->withTrashed();
    }

    /**
     * Get the Status that owns the Notes.
     */
    public function status()
    {
        return $this->belongsTo('App\Models\Status', 'status_id');
    }


    public function creative()
    {
        return $this->hasMany(Creative::class);
    }

    public function adformat()
    {
        return $this->belongsTo(AdFormat::class, 'ad_format_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
