<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use SoftDeletes;
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Return list of units for a business
     *
     * @param  bool  $show_none  = true
     */
    public static function forDropdown(int $business_id, bool $show_none = false, $only_base = true): array
    {
        $query = Unit::where('business_id', $business_id);
        if ($only_base) {
            $query->whereNull('base_unit_id');
        }

        $units = $query->select(DB::raw('CONCAT(actual_name, " (", short_name, ")") as name'), 'id')->get();
        $dropdown = $units->pluck('name', 'id');
        if ($show_none) {
            $dropdown->prepend(__('messages.please_select'), '');
        }

        return $dropdown;
    }

    public function sub_units(): HasMany
    {
        return $this->hasMany(\App\Unit::class, 'base_unit_id');
    }

    public function base_unit(): BelongsTo
    {
        return $this->belongsTo(\App\Unit::class, 'base_unit_id');
    }
}
