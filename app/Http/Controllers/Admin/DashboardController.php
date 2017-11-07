<?php
    
    namespace App\Http\Controllers\Admin;
    
    use Illuminate\Http\Request;
    use App\Meta;
    use DB;
    use Config;
    use App\Cms;
    use App\User;
    use Carbon\Carbon;
    use App\InternationalLead;
    use Helpers;
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
        public function __construct( Request $request )
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
            
            $currMonth = date('m');
            
            $user      = Helpers::getCurrentUserDetails();
            $userID    = $user->id;
//
            
            $graphData = InternationalLead::select(DB::RAW("count(DISTINCT lead_id) as tot_cnt") , DB::RAW("DATE(created_at) as date"))->groupBy('date')->orderBy('created_at','ASC')->where('user_added_by' , $userID)->get();
//            return $graphData;
//          calculations to show whether the monthly target has been achieved or not.
//            $details                 = InternationalLead::select(DB::RAW("sum(amount) as tot_amt") , DB::RAW("MONTH(created_at) as month"))->groupBy(DB::RAW("MONTH(created_at)"))->where('status' , 'converted')->where('user_added_by' , $userID)->get()->toArray();
//            $currMonth = date('m');
//            $months = array_column($details, 'month');
//            $monthly[ 'target' ]     = $monthlyTarget = $user->monthly_target;
//            if(!in_array($currMonth , $months))
//            {
//                $details[] = array('tot_amt' => 0 , 'month' => (int) $currMonth) ;
//
//                $monthly[ 'calculated' ] = $monthlyTargetCalculated = 0;
//                $monthly[ 'achieved' ] = $targetAchieved = $monthlyTargetCalculated < $monthlyTarget ? FALSE : TRUE;
//            } else
//            {
//                $key = array_search($currMonth, $months);
//
//                $monthly[ 'calculated' ] = $monthlyTargetCalculated = $details[ $key ]['tot_amt'];
//                $monthly[ 'achieved' ] = $targetAchieved = $monthlyTargetCalculated < $monthlyTarget ? FALSE : TRUE;
//            }
            
            $details   = InternationalLead::select(DB::RAW("sum(amount) as tot_amt") , DB::RAW("MONTH(created_at) as month"))
                         ->where(DB::raw('MONTH(created_at)') , '=' , $currMonth)
                         ->where('status' , 'converted')
                         ->where('user_added_by' , $userID)->first()->toArray();
            
            if ( $details[ 'tot_amt' ] == NULL )
                $details[ 'tot_amt' ] = 0;
            if ( $details[ 'month' ] == NULL )
                $details[ 'month' ] = $currMonth;
    
            $monthly[ 'target' ]     = $monthlyTarget = $user->monthly_target;
            $monthly[ 'calculated' ] = $monthlyTargetCalculated = $details[ 'tot_amt' ];
            $monthly[ 'achieved' ]   = $targetAchieved = $monthlyTargetCalculated < $monthlyTarget ? FALSE : TRUE;
            
            return view('admin.dashboard' , compact("monthly","graphData"));
        }
        
        public function dashboard()
        {
            
            return view('home1' , compact('login'));
        }
        
        public function pagecontent()
        {
            //dd($_SERVER);
            $cms = Cms::findOrFail('1');
            
            return view('pagecontent' , compact('cms' , 'login'));
        }
        
        
        public function privacypolicy()
        {
            //dd($_SERVER);
            $cms = Cms::findOrFail('2');
            
            return view('pagecontent' , compact('cms'));
        }
        
        public function termsconditions()
        {
            //dd($_SERVER);
            $cms = Cms::findOrFail('5');
            
            return view('pagecontent' , compact('cms'));
        }
        
        public function login()
        {
            $cms = Cms::findOrFail('5');
            
            return view('login' , compact('cms'));
        }
        
        public function register( Request $request )
        {
            $validator = Validator::make($request->all() ,
                                         [
                                             'username' => 'required|max:255' ,
                                             'email'    => 'required|email|max:255|unique:users' ,
                                             'password' => 'required|min:6' ,
                                         ] ,
                                         $messages = array( 'email.unique' => 'This email already exists' ));
            
            if ( $validator->fails() )
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            
            //dd($request);die();
            $user           = new User;
            $user->fullname = $request->input('username');
            $user->lastname = $request->input('username');
            $user->email    = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->status   = 1;
            if ( $user->save() )
            {
                return redirect('signin')->with('success' , 'Registered successfully.');
            } else
            {
                return redirect('signin')->with('failure' , 'Something Went Wrong!!!.');
            }
            //return redirect()->intended('signin');
        }
        
        public function signin( Request $request )
        {
            $validator = Validator::make($request->all() ,
                                         [
                                             'login_email'    => 'required' ,
                                             'login_password' => 'required' ,
                                         ]);
            
            if ( $validator->fails() )
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $email    = $request->input('login_email');
            $password = $request->input('login_password');
            if ( Auth::attempt([ 'email' => $email , 'password' => $password ]) )
            {
                //dd("here");
                return redirect()->intended('signin');
            } else
            {
                //dd("in");
            }
        }
        
        protected function guard()
        {
            return Auth::guard();
        }
        
        public function logout( Request $request )
        {
            $this->guard()->logout();
            
            $request->session()->flush();
            
            $request->session()->regenerate();
            
            return redirect('/index');
        }
    }
