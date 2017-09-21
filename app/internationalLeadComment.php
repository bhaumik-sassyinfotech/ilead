<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class internationalLeadComment extends Model
{
    //
    use softDeletes;
    protected $dates = ['deleted_at'];
//
//    public function lead()
//    {
//        return $this->belongsTo('App\InternationalLead');
//    }
    
}
