<?php namespace TeamGrid\Tasks\Http\Middlewares;
 
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use TeamGrid\Projects\Models\Project;
use TeamGrid\Tasks\Models\Task;
use TeamGrid\Tasks\Models\TaskSubscriber;
 
class TaskMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $task = Task::find($request->route('id'));
        
        if (!$task) {
            return response()->json(['error' => 'Task does not exists.'], 403);
        }

        $taskProject = Project::find($task->project_id);
        if ($taskProject->project_manager_id != auth()->user()->id) {
            return response()->json(['error' => 'You do not have permissions for this action.'], 403);
        }
 
        return $next($request);
    }
}