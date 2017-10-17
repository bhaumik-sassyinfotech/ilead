<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public function note()
    {
        return $this->hasOne('App\InternationalLeadNote', 'lid','lead_id')->latest('created_at');
    }
    
    public function currencies()
    {
        return $this->hasOne('App\Currency','id','currency');
    }
    
    public function userDetails()
    {
        return $this->hasOne('App\User','id','user_added_by');
    }
    
    public function notes()
    {
//        return $this->hasMany('App\InternationalLeadNote' , 'lid' , 'lead_id')->latest('created_at');
        return $this->hasMany('App\InternationalLeadNote' , 'lid' , 'lead_id');
    }
}
