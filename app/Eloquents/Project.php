<?php

namespace App\Eloquents;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Get tasks
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany('App\Eloquents\Task');
    }
}
