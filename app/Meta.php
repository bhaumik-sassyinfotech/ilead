<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meta extends Model
{
    use SoftDeletes;

    protected $fillable = ['website_title','meta_title', 'meta_keyword', 'meta_description', 'url'];
}
