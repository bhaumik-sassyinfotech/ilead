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

}
