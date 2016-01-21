<?php

namespace App\Http\Controllers\Api\v1;

use App\Eloquents\Task;
use App\Http\Controllers\Api\v1\BaseApiController;
use App\Http\Requests;
use App\Http\Requests\TaskRequest;
use App\Transformers\TaskTransformer;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;
use Illuminate\Http\Request;

class TaskController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tasks = Task::all();
        $tasks = Task::paginate(5);

        return Fractal::collection($tasks, new TaskTransformer())->responseJson(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $task = Task::create($request->all());

        return Fractal::item($task, new TaskTransformer())->responseJson(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);

        return Fractal::item($task, new TaskTransformer())->responseJson(200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->fill($request->all());
        $task->save();

        return Fractal::item($task, new TaskTransformer())->responseJson(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return Fractal::collection(Task::all(), new TaskTransformer())->responseJson(200);        
    }
}
