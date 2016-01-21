<?php

namespace App\Transformers;

use App\Eloquents\Task;
use League\Fractal;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class ProjectTaskTransformer extends TransformerAbstract
{
    /**
     * Transform object into a generic array
     *
     * @var  object
     */
    public function transform(Task $task)
    {
        return [
            'id'          => (int) $task->id,
            'name'        => $task->name,
            'slug'        => $task->slug,
            'completed'   => (bool) $task->completed,
            'description' => $task->description,
        ];
    }

}
