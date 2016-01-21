<?php

namespace App\Http\Controllers\Api\v1;

use App\Eloquents\Project;
use App\Http\Controllers\Api\v1\BaseApiController;
use App\Http\Requests;
use App\Http\Requests\TaskRequest;
use App\Transformers\ProjectTaskTransformer;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;
use Illuminate\Http\Request;

class ProjectTaskController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        return Fractal::collection($project->tasks, new ProjectTaskTransformer())->responseJson(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request, $id)
    {
        $project = Project::findOrFail($id);

        return Fractal::collection($project->tasks, new ProjectTaskTransformer())->responseJson(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $task_id)
    {
        $project = Project::findOrFail($id);
        $task = $project->tasks()->whereId($task_id)->first();

        if (! $task) {
            return response()->json(['error' => 'Invalid task id'], 401);
        }

        return Fractal::item($task, new ProjectTaskTransformer())->responseJson(200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, $id, $task_id)
    {
        $project = Project::findOrFail($id);
        $task = $project->tasks()->whereId($task_id)->first();

        if (! $task) {
            return response()->json(['error' => 'Invalid task id'], 401);
        }

        return Fractal::collection($project->tasks, new ProjectTaskTransformer())->responseJson(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $task_id)
    {
        $project = Project::findOrFail($id);
        $task = $project->tasks()->whereId($task_id)->first();

        if (! $task) {
            return response()->json(['error' => 'Invalid task id'], 401);
        }

        $task->delete();

        return Fractal::collection($project->tasks, new ProjectTaskTransformer())->responseJson(200);
    }
}