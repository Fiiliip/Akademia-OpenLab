<?php namespace TeamGrid\Projects\Http\Middlewares;
 
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use TeamGrid\Projects\Models\Project;
 
class ProjectMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $project = Project::find($request->route('id'));
        
        if (!$project) {
            return response()->json(['error' => 'Project does not exists.'], 404);
        }

        if ($project->project_manager_id != auth()->user()->id) {
            return response()->json(['error' => 'You do not have permissions for this action.'], 403);
        }
 
        return $next($request);
    }
}