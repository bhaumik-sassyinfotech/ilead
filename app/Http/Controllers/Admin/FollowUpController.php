<?php
    
    namespace App\Http\Controllers\Admin;
    
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use App\FollowUp;
    use Config;
    use Illuminate\Support\Facades\Redirect;
    use Illuminate\Support\Facades\Validator;
    
    class FollowUpController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            //
            $follow_up_list = FollowUp::whereNull('deleted_at')->paginate(10);

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
            $follow->title = $request->title;
            $follow->label = str_slug($request->title , '_');
            
            
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
            //
            $follow = FollowUp::where(array('id' => $id , 'deleted_at' => NULL))->first();
            $follow_up_list = FollowUp::whereNull('deleted_at')->paginate(10);
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
         * @param  \App\FollowUp            $followUp
         * @return \Illuminate\Http\Response
         */
        public function update($id , Request $request)
        {
            //
            $validator = Validator::make($request->all() ,
                [
                    'title' => "required|unique:follow_ups" ,
                ]
            );
            
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            
            $follow = FollowUp::find($id);
            $follow->title = $request->title;
            $follow->label = str_slug($request->title , "_");
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
                    return redirect()->route('follow_up.index')->with('err_msg' , 'Follow up ' . Config::get('constant.TRY_MESSAGE'));
                }
            }
            
            return redirect()->route('follow_up.index')->with('err_msg' , Config::get('constant.TRY_MESSAGE'));
        }
    }
