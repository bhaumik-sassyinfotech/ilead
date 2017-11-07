<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LocalLeadNote extends Model
{
    //
    use SoftDeletes;
    protected $primaryKey = 'note_id';
    protected $dates = ['deleted_at'];
    
    public function notes()
    {
        return $this->belongsTo('App\LocalLead','lid','lead_id');
    }
    
    public function noteUser()
    {
        return $this->hasOne('App\User', 'id' , 'user_added_by');
    }

}
