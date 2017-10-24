<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InternationalLeadNote extends Model
{
    //
    use SoftDeletes;
    protected $primaryKey = 'note_id';
    protected $dates = ['deleted_at'];
    
    public function notes()
    {
        return $this->belongsTo('App\InternationalLead','lid','lead_id');
    }
    
    public function noteUser()
    {
        return $this->hasOne('App\User', 'id' , 'user_updated_by');
    }
    

}
