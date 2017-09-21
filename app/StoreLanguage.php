<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreLanguage extends Model
{
    protected $table = 'store_language';
    use SoftDeletes;

    protected $fillable = ['lang_name','iso_631_1_code'];
}
