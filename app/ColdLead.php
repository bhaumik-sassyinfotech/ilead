<?php
    
    namespace App;
    
    
    use Illuminate\Database\Eloquent\Model;
    
    use Illuminate\Database\Eloquent\SoftDeletes;

//use app\InternationalLeadComment;
    
    class ColdLead extends Model
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
            return $this->hasOne('App\ColdLeadNote', 'lid','lead_id')->latest('created_at');
        }
        
        public function currencies()
        {
            return $this->hasOne('App\Currency','id','currency');
        }
        
        
        public function notes()
        {
//        return $this->hasMany('App\InternationalLeadNote' , 'lid' , 'lead_id')->latest('created_at');
            return $this->hasMany('App\ColdLeadNote' , 'lid' , 'lead_id');
        }
        
    }
