<?php

namespace Modules\Hms\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HmsCoupon extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
}
