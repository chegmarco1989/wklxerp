<?php

namespace Modules\Spreadsheet\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Spreadsheet extends Model
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
    protected $table = 'sheet_spreadsheets';

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'sheet_data' => 'array',
        ];
    }

    /**
     * user who created a sheet.
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(\App\User::class, 'created_by');
    }

    public function shares(): HasMany
    {
        return $this->hasMany(\Modules\Spreadsheet\Entities\SpreadsheetShare::class, 'sheet_spreadsheet_id');
    }
}
