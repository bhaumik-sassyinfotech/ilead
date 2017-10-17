<?php
    
    namespace App\Http\Controllers\Admin;
    
    use Helpers;
    use Illuminate\Http\Request;
    use App\User;
    use App\Http\Controllers\Controller;
    use Config;
    
    class ReportController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index($id = '')
        {
            // $id = 1 => International Lead
            // $id = 2 => Local Lead
            // $id = 3 => Cold Lead
            
            $user = Helpers::getCurrentUserDetails();
            $isManager = FALSE;
            $module='';
            $leads=array();
            if ($id == 1)
            {//international Lead
                $module='international';
                if ($user->role->id == Config::get('constant.MANAGER_ID'))
                {
                    
                    $isManager = TRUE;
                    $managers = User::where('role_id' , Config::get('constant.MANAGER_ID'))->get();
                    foreach ($managers as $manager)
                    {
                        $json = json_decode($manager->module);
                        if($json->$module == 'TRUE')
                        {
                            $leads[] = $manager;
                        }
                    }
                }
//                else if($user->role->id == Config::get('constant.EMPLOYEE_ID')) {
//
//                }
            } else if ($id == 2)
            {//local lead
                dd("local");
            } else if ($id == 3)
            {//cold lead
                dd("cold");
            } else
            {
                dd("none of the above");
            }
            
        }
        
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            //
        }
        
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
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
            //
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
        public function update(Request $request , $id)
        {
            //
        }
        
        /**
         * Remove the specified resource from storage.
         *
         * @param  int $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            //
        }
        
        public function internationalIndex()
        {
            dd("internationalIndex");
        }
    }
