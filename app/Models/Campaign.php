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
        return $this->hasOne(Creative::class);
    }

    public function goal()
    {
        return $this->belongsTo(Goal::class);
    }

    public function objective()
    {
        return $this->belongsTo(Objective::class);
    }

    public function interest()
    {
        return $this->belongsTo(Interest::class);
    }

    public function media_type()
    {
        return $this->belongsTo(MediaType::class, 'media_type_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
