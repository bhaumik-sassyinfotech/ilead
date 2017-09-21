<?php
namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 *
 * @package App
 * @property string $title
*/
class Plans extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
    	'name',
		'subscription_period',
		'subscription_perice',
		'status'
    	];
        
}
