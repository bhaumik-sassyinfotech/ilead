<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InternationalReminder extends Model
{

    use SoftDeletes;
    protected $primaryKey = 'reminder_id';
    protected $dates = ['deleted_at'];
    
    public function reminderUser()
    {
        return $this->hasOne('App\User', 'id' , 'user_added_by');
    }
    
    
}
