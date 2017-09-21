<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Meta;
use DB;
use Config;
use App\Cms;
use App\User;
use Validator;
use Redirect;
use Auth;
use App\Http\Controllers\Admin\AdminController;

class DashboardController extends AdminController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard');
    }
    
    public function dashboard()
    {
        
        return view('home1',compact('login'));
    }
    
    public function pagecontent()
    {
        //dd($_SERVER);
        $cms = Cms::findOrFail('1');
        
        return view('pagecontent',compact('cms','login'));
    }
    
    
    public function privacypolicy()
    {
        //dd($_SERVER);
        $cms = Cms::findOrFail('2');
        
        return view('pagecontent',compact('cms'));
    }
    
    public function termsconditions()
    {
        //dd($_SERVER);
        $cms = Cms::findOrFail('5');
        return view('pagecontent',compact('cms'));
    }
    
    public function login()
    {
        $cms = Cms::findOrFail('5');
        return view('login',compact('cms'));
    }
    
    public function register(Request $request)
    {
        $validator = Validator::make( $request->all(),
            [
            'username' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            ],
        $messages = array( 'email.unique' => 'This email already exists' ));

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        
        //dd($request);die();
        $user = new User;
        $user->fullname = $request->input('username');
        $user->lastname = $request->input('username');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->status = 1;
        if($user->save()){
            return redirect('signin')->with('success', 'Registered successfully.');
        }
        else {
            return redirect('signin')->with('failure', 'Something Went Wrong!!!.');
        }
            //return redirect()->intended('signin');
    }
    
    public function signin(Request $request) {
        $validator = Validator::make( $request->all(),
        [
            'login_email' => 'required',
            'login_password' => 'required',
        ]);
        
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $email = $request->input('login_email');
        $password = $request->input('login_password');
        if (Auth::attempt(['email' => $email, 'password' => $password]))
        {
            //dd("here");
            return redirect()->intended('signin');
        }
        else {
            //dd("in");
        }
    }
    
    protected function guard()
    {
        return Auth::guard();
    }
    
     public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/index');
    }
}
