<?php namespace TeamGrid\Tasks\Models;

use Model;
use DateTime;
use DateInterval;

/**
 * Task Model
 */
class Task extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'teamgrid_tasks_tasks';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'project_id',
        'title',
        'planned_start',
        'planned_end',
        'planned_time',
        'is_done'
    ];

    /**
     * @var array Validation rules for attributes
     */
    public $rules = [
        'project_id' => 'required',
        'title' => 'required',
    ];

    /**
     * @var array Attributes to be cast to native types
     */
    protected $casts = [];

    /**
     * @var array Attributes to be cast to JSON
     */
    protected $jsonable = [];

    /**
     * @var array Attributes to be appended to the API representation of the model (ex. toArray())
     */
    protected $appends = [];

    /**
     * @var array Attributes to be removed from the API representation of the model (ex. toArray())
     */
    protected $hidden = [];

    /**
     * @var array Attributes to be cast to Argon (Carbon) instances
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [
        'time_entries' => ['TeamGrid\TimeEntries\Models\TimeEntry']
    ];
    public $hasOneThrough = [];
    public $hasManyThrough = [];
    public $belongsTo = [
        'project' => ['TeamGrid\Projects\Models\Project'],
    ];
    public $belongsToMany = [
        'users' => ['RainLab\User\Models\User']
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public function afterUpdate() {
        $project = $this->project;

        if (!$project) return;

        $totalTaskCount = $project->tasks()->count();
        $completedTaskCount = $project->tasks()->where('is_completed', true)->count();

        $totalTaskCount == $completedTaskCount ? $project->is_completed = true : $project->is_completed = false;
        
        $project->save();

        if ($this->start_time && $this->end_time) {
            $start_time = new DateTime($this->start_time);
            $this->planned_time = $start_time->diff(new DateTime($this->end_time));
            $this->save();
        }
    }

    public function getTotalTimeSpent() {
        $totalTime = new DateInterval("PT0S");
        foreach ($this->time_entries as $time_entry) {
            $duration = $time_entry->getDuration();

            $totalTime->h += $duration->h;
            $totalTime->i += $duration->i;
            $totalTime->s += $duration->s;

            $totalTime->i += intdiv($totalTime->s, 60);
            $totalTime->s = $totalTime->s % 60;

            $totalTime->h += intdiv($totalTime->i, 60);
            $totalTime->i = $totalTime->i % 60;
        }

        return $totalTime;
    }

    public function getTotalTimeSpentAttribute() {
        $totalTime = $this->getTotalTimeSpent();
        return sprintf('%02d:%02d:%02d', $totalTime->h, $totalTime->i, $totalTime->s);
    }
}
