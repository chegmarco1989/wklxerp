<?php

namespace Modules\Essentials\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class ToDo extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'essentials_to_dos';

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(\App\User::class, 'essentials_todos_users', 'todo_id', 'user_id');
    }

    public function assigned_by(): BelongsTo
    {
        return $this->belongsTo(\App\User::class, 'created_by');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(\Modules\Essentials\Entities\EssentialsTodoComment::class, 'task_id')->orderBy('id', 'desc');
    }

    public function media(): MorphMany
    {
        return $this->morphMany(\App\Media::class, 'model');
    }

    public static function getTaskStatus()
    {
        $statuses = [
            'new' => __('essentials::lang.new'),
            'in_progress' => __('essentials::lang.in_progress'),
            'on_hold' => __('essentials::lang.on_hold'),
            'completed' => __('restaurant.completed'),
        ];

        return $statuses;
    }

    public static function getTaskPriorities()
    {
        $priorities = [
            'low' => __('essentials::lang.low'),
            'medium' => __('essentials::lang.medium'),
            'high' => __('essentials::lang.high'),
            'urgent' => __('essentials::lang.urgent'),
        ];

        return $priorities;
    }

    /**
     * Attributes to be logged for activity
     */
    public function getLogPropertiesAttribute()
    {
        $properties = ['status'];

        return $properties;
    }
}
