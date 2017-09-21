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
    
    
    public function scopeDesc($query)
    {
        return $query->orderBy( 'updated_at' , 'DESC');
    }
    
//    public function comments()
//    {
//        return $this->hasMany('App\InternationalLeadComment', 'lid','lead_id')->orderBy( 'updated_at' , 'DESC');
//    }
    
    public function latestComment()
    {
        return $this->hasOne('App\InternationalLeadComment', 'lid','lead_id')->orderBy( 'updated_at' , 'DESC');
    }
    
}
