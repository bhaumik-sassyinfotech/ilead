<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    use SoftDeletes;

    protected $table = 'design';
    
    protected $fillable = [
    	'name',
		'design_image',
    ];
}
