<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faqmodule extends Model {

    use SoftDeletes;

    protected $table = 'faqmodule';
    protected $fillable = ['question', 'answer', 'cat_id'];

}
