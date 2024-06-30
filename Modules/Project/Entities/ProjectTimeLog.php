<?php

namespace Modules\Project\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ProjectTimeLog extends Model
{
    use LogsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pjt_project_time_logs';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    protected static $logUnguarded = true;

    protected static $logOnlyDirty = true;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty();
    }

    /**
     * Get the task for time log.
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo('Modules\Project\Entities\ProjectTask', 'project_task_id');
    }

    /**
     * Get the user for time log.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }

    /**
     * Get the user who added time log.
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(\App\User::class, 'created_by');
    }

    /**
     * Return the project for a time log.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo('Modules\Project\Entities\Project', 'project_id');
    }
}
