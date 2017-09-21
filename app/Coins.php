<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coins extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'coin_bags'];
}
