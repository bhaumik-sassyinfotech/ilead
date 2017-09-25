<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

//use app\InternationalLeadComment;

class InternationalLead extends Model
{
    //
    use SoftDeletes;
    protected $primaryKey = 'lead_id';
    protected $dates = ['deleted_at'];
    
    
    public function latestComment()
    {
        return $this->hasOne('App\InternationalLeadComment', 'lid','lead_id');
    }
    
    public function notes()
    {
        return $this->hasMany('App\InternationalLeadNote' , 'lid' , 'lead_id')->latest('created_at');
    }
    
}
