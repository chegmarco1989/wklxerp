<?php

namespace Modules\AiAssistance\Entities;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\User;
use Illuminate\Database\Eloquent\Model;

class AiAssistanceHistory extends Model
{
    protected $table = 'aiassistance_history';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    protected $casts = [
        'input_data' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
