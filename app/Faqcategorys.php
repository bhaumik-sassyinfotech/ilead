<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faqcategorys extends Model {

    use SoftDeletes;

    protected $table = 'faqcategorys';
    protected $fillable = ['title', 'keyword', 'status'];

}
