<?php
    
    namespace App\Http\Controllers\Admin;
    
    use App\InternationalLead;
    use App\Currency;
    use Carbon\Carbon;
    use DebugBar\DebugBar;
    use Helpers;
    use Illuminate\Http\Request;
    use App\User;
    use App\Http\Controllers\Controller;
    use Config;
//    use DB;
    use Illuminate\Support\Facades\DB;

//    use Illuminate\Support\Facades\DB;
    
    class ReportController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
        
        }
        
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public
        function create()
        {
            //
        }
        
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response
         */
        public
        function store(Request $request)
        {
            //
        }
        
        /**
         * Display the specified resource.
         *
         * @param  int $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
        
        }
        
        public function listing($id , Request $request)
        {
            /*
             *
             *  @id = 1 => International
             *  @id = 2 => Local
             *  @id = 3 => Cold
             *
             *  */

//            dd($request->request);
            $onlyMyLead = FALSE;
            $loggedInUser = Helpers::getCurrentUserDetails();
            $loggedInRole = $loggedInUser->role->id;
            $json = json_decode($loggedInUser->module);
            $leads = array();
            $query = '';
            $searchQuery = '';
            $employees = $managers = [];
            $user = Helpers::getCurrentUserDetails();
//            dd($user);
            $userID = [];
            $startDate = $endDate = '';
            if ($id == 1)
            {
                $query = InternationalLead::with(['note' , 'currencies' , 'userDetails' , 'note.noteUser' , 'notesCount']);
                if ($loggedInRole == Config::get('constant.MANAGER_ID'))
                { // show only records of employee under current loggedIn manager
                    if ($request->only_my_leads == 1)
                    {
                        $onlyMyLead = TRUE;
                        $userID = (array) $user->id;
                    } else
                    {
                        if (!empty($request->employee))
                        {
                            $userID = $request->employee;
                        } else
                        {
                            $userID = User::where('manager_id' , $user->id)->pluck('id')->prepend($user->id)->toArray();
                        }
                    }
                    $employees = User::where('manager_id' , $user->id)->get();
//                    dd($userID);
                } else if ($loggedInRole == Config::get('constant.EMPLOYEE_ID'))
                {
//                    dd("emp");
                    $userID = (array) $user->id;
                    
                } elseif ($loggedInRole == Config::get('constant.ADMIN_ID'))
                {
                    
                    $managers = User::where('manager_id' , '=' , 0)->where('role_id' , '!=' , 1)->get();
                    $employees = User::where('manager_id' , '!=' , 0)->where('role_id' , Config::get('constant.EMPLOYEE_ID'))->get();
                    if ($request->only_my_leads == 1)
                    {
                        $onlyMyLead = TRUE;
                        $userID = (array) $user->id;
//                        dd($userID);
                    } else if (!empty($request->employee) || !empty($request->manager))
                    {
                        $userID = array_merge((array) $request->employee , (array) $request->manager);
                    } else {
                        $emp = $employees->pluck('id')->toArray();
                        $man = $managers->pluck('id')->toArray();
                        $userID = array_unique(array_merge((array) $emp , (array) $man , (array) $loggedInUser->id));
                    }
                   
//                    dd($managers->toArray());
                }
                //common for all
                if (!empty($request->start) && !empty($request->end))
                {
                    $startDate = new Carbon($request->start);
                    $endDate = new Carbon($request->end);
                    $startDate = $startDate->toDateTimeString();
                    $endDate = $endDate->addDay()->toDateTimeString();
//                    dd($startDate." - ".$endDate);
                    $query = $query->whereBetween('created_at' , [$startDate , $endDate]);
                    
                    $endDate = new Carbon($request->end);
                }
                
                if (!empty($request->searchQuery))
                {
                    $searchQuery = $request->searchQuery;
                    $query = $query->where("project_name" , "like" , "%{$searchQuery}%")->orWhere("contact_person" , "like" , "%{$searchQuery}%")->orWhere("comment" , "like" , "%{$searchQuery}%")->orWhere("tags" , "like" , "%{$searchQuery}%")->orWhere("job_title" , "like" , "%{$searchQuery}%")->orWhere("refer_id" , "like" , "%{$searchQuery}%")->orWhere("type" , "like" , "%{$searchQuery}%");
                }
                $query = $query->whereIn('user_added_by' , $userID);
                
                $leads = $query->latest('created_at')->paginate(Config::get('constant.PAGINATION_MIN'));
//                $leads = $query->latest('created_at')->toSql();
//                dd($leads);
            }
            
            return view('admin.reports.index' , compact('leads' , 'onlyMyLead' , 'managers' , 'employees' , 'startDate' , 'endDate' , 'searchQuery'));
        }
        
        /**
         * Show the form for editing the specified resource.
         *
         * @param  int $id
         * @return \Illuminate\Http\Response
         */
        public
        function edit($id)
        {
            //
        }
        
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @param  int                      $id
         * @return \Illuminate\Http\Response
         */
        public
        function update(Request $request , $id)
        {
            //
        }
        
        /**
         * Remove the specified resource from storage.
         *
         * @param  int $id
         * @return \Illuminate\Http\Response
         */
        public
        function destroy($id)
        {
            //
        }
        
        public function searchEmployees(Request $request)
        { // ajax request
            if ($request->ajax())
            {
                $employees = User::select('id' , 'fullname' , 'lastname')->where('role_id' , Config::get('constant.EMPLOYEE_ID'))->where('manager_id' , $request->manager_id)->get();
                
                return response()->json(['employees' => $employees]);
            }
            
            return FALSE;
        }
    }
