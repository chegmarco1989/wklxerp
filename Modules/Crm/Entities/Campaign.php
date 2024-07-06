<?php

namespace Modules\Crm\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Campaign extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'crm_campaigns';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'contact_ids' => 'array',
            'additional_info' => 'array',
        ];
    }

    /**
     * user who created a campaign.
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(\App\User::class, 'created_by');
    }

    public static function getTags()
    {
        return ['{contact_name}', '{campaign_name}', '{business_name}'];
    }
}
