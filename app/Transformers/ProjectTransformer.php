<?php

namespace App\Transformers;

use App\Eloquents\Project;
use App\Transformers\TaskTransformer;
use League\Fractal;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class ProjectTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'tasks'
    ];

    /**
     * Transform object into a generic array
     *
     * @var  object
     */
    public function transform(Project $project)
    {
        return [
            'id'   => (int) $project->id,
            'name' => $project->name,
            'slug' => $project->slug,
        ];
    }


    public function includeTasks(Project $project)
    {
        return $this->collection($project->tasks, new TaskTransformer());
    }
}
