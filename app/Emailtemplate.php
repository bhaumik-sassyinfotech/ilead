<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Emailtemplate extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'emailtemplate';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];


    use SoftDeletes;
    protected $dates = ['deleted_at'];

   
}
