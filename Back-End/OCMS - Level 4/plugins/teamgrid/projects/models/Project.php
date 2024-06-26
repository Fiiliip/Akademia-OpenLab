<?php namespace TeamGrid\Projects\Models;

use Model;
use DateInterval;

/**
 * Project Model
 */
class Project extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'teamgrid_projects_projects';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'title',
        'customer_id',
        'project_manager_id',
    ];

    /**
     * @var array Validation rules for attributes
     */
    public $rules = [
        'title' => 'required'
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
        'tasks' => ['TeamGrid\Tasks\Models\Task'],
    ];
    public $hasOneThrough = [];
    public $hasManyThrough = [];
    public $belongsTo = [
        'project_manager' => ['RainLab\User\Models\User'],
        'customer' => ['RainLab\User\Models\User']
    ];
    public $belongsToMany = [
        'users' => ['RainLab\User\Models\User']
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public function getTaskCountAttribute() 
    {
        return $this->tasks()->count();
    }

    public function getCompletedTaskCountAttribute()
    {
        return $this->tasks()->where('is_completed', true)->count();
    }

    public function getAnotherCompletedTaskCountAttribute()
    {
        $totalTaskCount = $this->tasks()->count();
        $completedTaskCount = $this->tasks()->where('is_completed', true)->count();

        return "{$completedTaskCount} / {$totalTaskCount}";
    }

    public function getTotalTimeSpent() {
        $totalTime = new DateInterval("PT0S");
        foreach ($this->tasks as $task) {
            $duration = $task->getTotalTimeSpent();

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
