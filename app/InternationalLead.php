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


//    public function latestComment()
//    {
//        return $this->hasOne('App\InternationalLeadComment', 'lid','lead_id');
//    }
        
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
