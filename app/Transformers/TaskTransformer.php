<?php

namespace App\Transformers;

use App\Eloquents\Task;
use App\Transformers\ProjectTransformer;
use League\Fractal;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class TaskTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
        'project',
    ];

    /**
     * Transform object into a generic array
     *
     * @var  object
     */
    public function transform(Task $task)
    {
        return [
            'id'          => (int) $task->id,
            'project_id'  => (int) $task->project_id,
            'name'        => $task->name,
            'slug'        => $task->slug,
            'completed'   => (bool) $task->completed,
            'description' => $task->description,
        ];
    }

    public function includeProject(Task $task)
    {
        return $this->item($task->project, new ProjectTransformer());
    }
}
