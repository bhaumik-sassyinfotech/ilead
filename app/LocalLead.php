<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class LocalLead extends Model
{
    
    use SoftDeletes;
    protected $fillable   = ['contact_person', 'company_name', 'job_title', 'source_id', 'phone_number_1', 'phone_number_2', 'email', 'address', 'industry', 'url', 'comment', 'type', 'refer_id', 'status', 'tags', 'currency', 'amount', 'user_added_by'];
    protected $dates      = ['deleted_at'];
    protected $primaryKey = 'lead_id';
    
    public function note()
    {
        return $this->hasOne('App\LocalLeadNote', 'lid', 'lead_id')->latest('created_at');
    }
    
    public function currencies()
    {
        return $this->hasOne('App\Currency', 'id', 'currency');
    }
    
    public function notes()
    {//        return $this->hasMany('App\InternationalLeadNote' , 'lid' , 'lead_id')->latest('created_at');
        return $this->hasMany('App\LocalLeadNote', 'lid', 'lead_id');
    }
    
    public function userDetails()
    {
        return $this->hasOne('App\User', 'id', 'user_added_by');
    }
    
    public function notesCount()
    {
        return $this->hasOne('App\LocalLeadNote', 'lid', 'lead_id')
            ->selectRaw('lid, count(*) as count')
            ->groupBy('lid');
    }

//    public function reminders()
//    {
//        return $this->hasMany('App\LocalReminder' , 'lid' , 'lead_id');
//    }
}