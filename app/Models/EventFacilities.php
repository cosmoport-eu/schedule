<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class EventFacilities extends MainModel
{
    use SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    public $guarded = ['id'];
}
