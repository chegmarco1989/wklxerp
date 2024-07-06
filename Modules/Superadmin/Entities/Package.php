<?php

namespace Modules\Superadmin\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'custom_permissions' => 'array',
        ];
    }

    /**
     * Scope a query to only include active packages.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', 1);
    }

    /**
     * Returns the list of active pakages
     */
    public static function listPackages($exlude_private = false): object
    {
        $packages = Package::active()
            ->orderby('sort_order');

        if ($exlude_private) {
            $packages->notPrivate();
        }

        return $packages->get();
    }

    /**
     * Scope a query to exclude private packages.
     */
    public function scopeNotPrivate(Builder $query): Builder
    {
        return $query->where('is_private', 0);
    }
}
