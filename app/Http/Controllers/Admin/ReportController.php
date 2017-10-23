<?php
    
    namespace App\Http\Controllers\Admin;
    
    use App\InternationalLead;
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
            
            $loggedInUser = Helpers::getCurrentUserDetails();
            $loggedInRole = $loggedInUser->role->id;
            $json = json_decode($loggedInUser->module);
            $leads = array();
            if ($id == 1)
            {
//                if ($loggedInRole == Config::get('constant.ADMIN_ID'))
//                { //select managers
//                    
//                    dd($leads);
//                } else if($loggedInRole == Config::get('constant.MANAGER_ID'))
//                {
//                
//                } else if($loggedInRole == Config::get('constant.EMPLOYEE_ID'))
//                {
//                
//                }
            }
        }
        
        /**
         * Show the form for editing the specified resource.
         *
         * @param  int $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
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
        
        public
        function internationalIndex()
        {
            dd("internationalIndex");
        }
    }
