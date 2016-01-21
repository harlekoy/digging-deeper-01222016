<?php

namespace App\Http\Controllers\Api\v1;

use App\Eloquents\Project;
use App\Http\Controllers\Api\v1\BaseApiController;
use App\Http\Requests;
use App\Http\Requests\ProjectRequest;
use App\Transformers\ProjectTransformer;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;
use Illuminate\Http\Request;

class ProjectController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        // $projects = Project::paginate();

        return Fractal::collection($projects, new ProjectTransformer())->responseJson(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $project = Project::create($request->all());

        return Fractal::item($project, new ProjectTransformer())->responseJson(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);

        return Fractal::item($project, new ProjectTransformer())->responseJson(200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->fill($request->all());
        $project->save();

        return Fractal::item($project, new ProjectTransformer())->responseJson(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return Fractal::collection(Project::all(), new ProjectTransformer())->responseJson(200);
    }
}