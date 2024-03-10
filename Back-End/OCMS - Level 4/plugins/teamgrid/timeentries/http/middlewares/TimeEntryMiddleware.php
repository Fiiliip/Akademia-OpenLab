<?php namespace TeamGrid\TimeEntries\Http\Middlewares;
 
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use TeamGrid\TimeEntries\Models\TimeEntry;
use TeamGrid\Tasks\Models\TaskSubscriber;
 
class TimeEntryMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('*/start/*')) {
            if (!TaskSubscriber::where('task_id', $request->route('task_id'))->where('subscriber_id', auth()->user()->id)->exists()) {
                return response()->json(['error' => 'You are not subscribed to this project.'], 403);
            }
        } else if ($request->is('*/stop/*')) {
            if (!TimeEntry::where('id', $request->route('id'))->where('user_id', auth()->user()->id)->exists()) {
                return response()->json(['error' => 'You do not have rights for stopping this time entry.'], 403);
            }
        }
 
        return $next($request);
    }
}