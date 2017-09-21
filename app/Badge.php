<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Badge extends Model
{
    use SoftDeletes;

    protected $table ='badge';

    protected $fillable = ['name', 'badge_image', 'badge_point'];
}
