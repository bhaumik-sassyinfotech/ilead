<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Settings extends Model
{
    protected $table = 'settings';
    use SoftDeletes;

    protected $fillable = ['key','value'];
}
