<?php namespace TeamGrid\TimeEntries\Models;

use Model;
use DateTime;

/**
 * TimeEntry Model
 */
class TimeEntry extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'teamgrid_timeentries_time_entries';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [
        'task_id',
        'user_id',
        'start_time',
        'end_time'
    ];

    /**
     * @var array Validation rules for attributes
     */
    public $rules = [
        'task_id' => 'required',
        'user_id' => 'required',
        'start_time' => 'required'
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
    public $hasMany = [];
    public $hasOneThrough = [];
    public $hasManyThrough = [];
    public $belongsTo = [
        'task' => ['TeamGrid\Tasks\Models\Task'],
        'user' => ['RainLab\User\Models\User'],
    ];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public function getDuration()
    {
        $start_time = new DateTime($this->start_time);
        $end_time = new DateTime($this->end_time) ?? new DateTime();

        return $start_time->diff($end_time);
    }

    public function getDurationAttribute()
    {
        return $this->getDuration()->format('%H:%I:%S');
    }
}
