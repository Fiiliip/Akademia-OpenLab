<?php namespace TeamGrid\Tasks\Http\Controllers;

use Backend\Classes\Controller;
use Illuminate\Http\Request;

use TeamGrid\Tasks\Models\Task;
use TeamGrid\Tasks\Http\Resources\TaskResource;

class TaskController extends Controller {
    public function index($project_id) {
        $tasks = Task::where('project_id', $project_id)->get();
        return TaskResource::collection($tasks);
    }

    public function show($task_id) {
        $task = Task::where('id', $task_id)->first();
        if ($task) {
            return new TaskResource($task);
        } else {
            return response()->json(['message' => 'Task not found'], 404);
        }
    }

    public function store(Request $request) {
        $task = new Task();
        $task->fill($request->all());
        $task->save();
        return new TaskResource($task);
    }

    public function update(Request $request, $task_id) {
        $task = Task::where('id', $task_id)->first();
        $task->fill($request->all());
        $task->save();
        return new TaskResource($task);
    }

    public function complete($task_id) {
        $task = Task::where('id', $task_id)->first();
        $task->is_completed = $task->is_completed ? false : true;
        $task->save();
        return new TaskResource($task);
    }
}