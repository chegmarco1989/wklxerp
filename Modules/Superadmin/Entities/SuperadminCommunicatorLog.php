<?php

namespace Modules\Superadmin\Entities;

use Illuminate\Database\Eloquent\Model;

class SuperadminCommunicatorLog extends Model
{
    protected $guarded = ['id'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'business_ids' => 'array',
        ];
    }
}
