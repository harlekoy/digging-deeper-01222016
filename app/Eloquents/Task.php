<?php

namespace App\Eloquents;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'project_id',
        'name',
        'slug',
        'completed',
        'description',
    ];

    /**
     * Get project
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Eloquents\Project');
    }
}
