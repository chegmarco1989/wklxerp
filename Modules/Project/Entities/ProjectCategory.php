<?php

namespace Modules\Project\Entities;

use Illuminate\Database\Eloquent\Relations\MorphedByMany;
use App\Category;

class ProjectCategory extends Category
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categorizables';

    /**
     * Get all of the category that are assigned to project.
     */
    public function project(): MorphedByMany
    {
        return $this->morphedByMany('Modules\Project\Entities\Project', 'categorizable');
    }
}
