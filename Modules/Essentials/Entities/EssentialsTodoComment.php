<?php

namespace Modules\Essentials\Entities;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class EssentialsTodoComment extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function added_by(): BelongsTo
    {
        return $this->belongsTo(\App\User::class, 'comment_by');
    }

    public function media(): MorphMany
    {
        return $this->morphMany(\App\Media::class, 'model');
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(\Modules\Essentials\Entities\ToDo::class, 'task_id');
    }
}
