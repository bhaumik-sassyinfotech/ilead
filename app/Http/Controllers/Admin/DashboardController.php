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
        public function index( Request $request )
        {
//            dd($request);
            
            $currMonth = date('m');
            
            $days  = date('t');
            $today = explode("-" , date('Y-m-d'));
            $from_date  = $start = date('Y-m-01');
            $to_date    = $end   = date('Y-m-t');
            
            $user   = Helpers::getCurrentUserDetails();
            $userID = $user->id;
//
            
            $lineChartQuery = InternationalLead::select(DB::RAW("count(DISTINCT lead_id) as tot_cnt") , DB::RAW("DATE(created_at) as date"))->groupBy('date')
                ->orderBy('created_at' , 'ASC')->where('user_added_by' , $userID);
            if ( !empty($request->from_date) && !empty($request->to_date) )
            {
                $from_date = date("Y-m-d H:i:s",strtotime($request->input('from_date')));
                $to_date = date("Y-m-d H:i:s",strtotime($request->input('to_date')."+1 day"));
                
            }
            $lineChartData = $lineChartQuery->whereBetween('created_at' , [ $from_date , $to_date ])->get();
            if ( !empty($request->from_date) && !empty($request->to_date) )
            {
                $to_date = date("Y-m-d H:i:s",strtotime($request->input('to_date')));
            }
            
            
            if($lineChartData->count() < 1)
            {
//                $graphData = collect(['tot_cnt' => '0' , 'date' => $from_date]);

                $lineChartData->put('tot_cnt', '0');
                $lineChartData->put('date', $from_date);
//                $graphData['tot_cnt'] = '0';
//                $graphData['date'] = $from_date;
            }
            $graph['lineChart'] = $lineChartData;
    
            $barChartData = InternationalLead::select(DB::RAW("SUM(amount) as tot_amt") , DB::RAW("DATE(created_at) as date") ,DB::RAW("MONTH(created_at) as month"))->groupBy('month')->where('status' , 'converted')->where('user_added_by' , $userID)->get();
//            return $barChartData;
            $barChartData->map(function($row){
                $row['month_name'] = date('M',strtotime($row['date']));
                return $row;
            });
            $graph['barChart'] = $barChartData;
            
            
//            return $barChartData;
//            $graph['barChart'] = $barChartData;

//            return $graph['barChart'];
            

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
            
            $details = InternationalLead::select(DB::RAW("SUM(amount) as tot_amt") , DB::RAW("MONTH(created_at) as month"))
                ->where(DB::raw('MONTH(created_at)') , '=' , $currMonth)
                ->where('status' , 'converted')
                ->where('user_added_by' , $userID)->whereBetween('created_at' , [ $start , $end ])->first()->toArray();
//            return $details;
            if ( $details[ 'tot_amt' ] == NULL )
                $details[ 'tot_amt' ] = 0;
            if ( $details[ 'month' ] == NULL )
                $details[ 'month' ] = $currMonth;
            
            $monthly[ 'target' ]     = $monthlyTarget = $user->monthly_target;
            $monthly[ 'calculated' ] = $monthlyTargetCalculated = $details[ 'tot_amt' ];
            $monthly[ 'achieved' ]   = $targetAchieved = $monthlyTargetCalculated < $monthlyTarget ? FALSE : TRUE;
            
            return view('admin.dashboard' , compact("monthly" , "graph",'from_date','to_date'));
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
