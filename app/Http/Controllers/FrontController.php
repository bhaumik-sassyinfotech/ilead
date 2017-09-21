<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Meta;
use DB;
use App\Cms;
use App\User;
use Validator;
use Redirect;
use Auth;
use Illuminate\Routing\Controller;

class FrontController extends Controller
{

    protected $validator = null;
    protected $_request = null;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        //$this->middleware('auth');
    }


    public function setFormValidator($request,$validator=array())
    {
        if(empty($validator) && !is_array($validator))
             throw new Exception("Validator value must be with array.", 1);   

       $this->validator = Validator::make( $request->all(),$validator);
            
            
    }
    public function checkValidation()
    {
        if($this->validator->fails()) {
                return \Redirect::back()->withErrors($this->validator)->withInput();
            }
        return null;
    }


    

    
}
