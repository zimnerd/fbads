<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Model
{
    use SoftDeletes;

    /**
     * Get the notes for the users.
     */
    public function notes()
    {
        return $this->hasMany('App\Models\Notes');
    }
    /**
     * Get the notes for the users.
     */
    public function campaigns()
    {
        return $this->hasMany(Campaign::class,'user_id');
    }

    protected $dates = [
        'deleted_at'
    ];
}
