<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model {

    use SoftDeletes;

    protected $table = 'currency';
    protected $fillable = ['lable', 'code', 'simbol', 'default_currency'];
    protected $dates = ['deleted_at'];
}
