<?php namespace TeamGrid\Projects\Http\Controllers;

use Backend\Classes\Controller;
use Illuminate\Http\Request;

use TeamGrid\Projects\Models\Project;
use TeamGrid\Projects\Http\Resources\ProjectResource;

class ProjectController extends Controller {
    public function index() {
        $projects = Project::all();
        return ProjectResource::collection($projects);
    }

    public function show($id) {
        $project = Project::where('id', $id)->first();
        if ($project) {
            return new ProjectResource($project);
        } else {
            return response()->json(['message' => 'Project not found'], 404);
        }
    }

    public function store(Request $request) {
        $project = new Project();
        $project->fill($request->all());
        $project->save();
        return new ProjectResource($project);
    }

    public function update(Request $request, $project_id) {
        $project = Project::where('id', $project_id)->first();
        $project->fill($request->all());
        $project->save();
        return new ProjectResource($project);
    }

    public function complete($project_id) {
        $project = Project::where('id', $project_id)->first();
        $project->is_completed = $project->is_completed ? false : true;
        $project->save();
        return new ProjectResource($project);
    }
}