<?php
    
    namespace App\Http\Controllers\Admin;
    
    use Illuminate\Http\Request;
    
    use App\Http\Controllers\Controller;
    use App\FollowUp;
    use Config;
    use Helpers;
    use Illuminate\Support\Facades\Redirect;
    use Illuminate\Support\Facades\Validator;
    
    class FollowUpController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function __construct()
        {
            $this->middleware(function ($request , $next) {
                if (Helpers::isAdmin() != 1)
                {
                    return redirect()->to('admin/dashboard');
                }
                return $next($request);
            });
        }
    
        public function index()
        {
            //
//            $follow_up_list = FollowUp::whereNull('deleted_at')->paginate(10);
            $follow_up_list = FollowUp::latest('created_at')->latest('created_at')->paginate(50);

//        dd($follow_up_list);
            return view('admin.follow_up.index' , compact('follow_up_list'));
        }
        
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            //
            return view('admin.follow_up.create');
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
//            dd($request);
            $validator = Validator::make($request->all() ,
                [
                    'title' => "required|unique:follow_ups" ,
                ]
            );
            
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            
            $follow = new FollowUp;
            $follow->title = trim($request->title);
            $follow->label = str_slug(trim($request->title) , '_');
            
            
            if ($follow->save())
            {
                return redirect()->route('follow_up.index')->with('success' , 'Follow up ' . Config::get('constant.ADDED_MESSAGE'));
            }
            
            
        }
        
        /**
         * Display the specified resource.
         *
         * @param  \App\FollowUp $followUp
         * @return \Illuminate\Http\Response
         */
        public function show(FollowUp $followUp)
        {
            //
        }
        
        /**
         * Show the form for editing the specified resource.
         *
         * @param  \App\FollowUp $followUp
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $follow = FollowUp::find($id); //->first();
            
            if (empty($follow))
            {
                return redirect()->route('follow_up.index')->with('err_msg' , Config::get('constant.TRY_MESSAGE'));
            }
            
            return view('admin.follow_up.edit' , compact('follow'));
            
        }
        
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response
         */
        public function update($id , Request $request)
        {
            //
            $validator = Validator::make($request->all() ,
                [
                    'title' => 'required|unique:follow_ups,title,'.$id ,
                ]
            );
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            
            $follow = FollowUp::find($id);
            $follow->title = trim($request->title);
            $follow->label = str_slug(trim($request->title) , "_");
            if ($follow->save())
            {
                return redirect()->route('follow_up.index')->with('success' , 'Follow up ' . Config::get('constant.UPDATE_MESSAGE'));
            } else
            {
                return redirect()->route('follow_up.index')->with('err_msg' , Config::get('constant.TRY_MESSAGE'));
            }
        }
        
        /**
         * Remove the specified resource from storage.
         *
         * @param  \App\FollowUp $followUp
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            //
            $follow = FollowUp::find($id);
            if (!empty($follow))
            {
                $follow->delete($id);
                if ($follow->trashed())
                {
                    return redirect()->route('follow_up.index')->with('success' , 'Follow up ' . Config::get('constant.DELETE_MESSAGE'));
                } else
                {
                    return redirect()->route('follow_up.index')->with('err_msg' , Config::get('constant.TRY_MESSAGE'));
                }
            }
            
            return redirect()->route('follow_up.index')->with('err_msg' , Config::get('constant.TRY_MESSAGE'));
        }
        
        public function followSearch(Request $request)
        {
           
            $query = '';
    
            if(isset($request->q))
                $query = $request->q;
    
            $follow_up_list = FollowUp::where("title","like","%{$query}%")->latest('created_at')->paginate(50);
//            dd($follow_up_list);
            return view('admin.follow_up.index' , compact('follow_up_list' , 'query'));
        }
    }
