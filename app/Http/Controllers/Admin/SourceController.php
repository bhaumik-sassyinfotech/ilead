<?php
    
    namespace App\Http\Controllers\Admin;
    
    use App\Source;
    use Illuminate\Http\Request;
    use Helpers;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Config;
    use Illuminate\Support\Facades\Redirect;
    use Illuminate\Support\Facades\Validator;
    
    class SourceController extends Controller
    {
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
    
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            //
            if (Source::count() > 0)
            {
                $sourcesData = Source::latest('created_at')->paginate(50);
                
                return view('admin.source.index' , compact('sourcesData'));
            }
            
            return redirect()->route('source.create');
        }
        
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            //
            return view("admin.source.create");
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
            $validator = Validator::make($request->all() ,
                [
                    'title' => "required|unique:sources" ,
                ]
            );
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
//            dd($request);
            $src = new Source();
            $src->title = $request->title;
            $src->label = str_slug($request->title , '_');
            
            if ($src->save())
            {
                return redirect()->route('source.index')->with('success' , 'Source ' . Config::get('constant.ADDED_MESSAGE'));
            } else
            { // save failed
                return redirect()->route('source.index')->with('err_msg' , 'Source ' . Config::get('constant.TRY_MESSAGE'));
            }
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
            $source = Source::find($id);
            if (empty($source))
            {
                return redirect()->route('source.index')->with('err_msg' , Config::get('constant.TRY_MESSAGE'));
            }
            
            return view('admin.source.edit' , compact('source'));
        }
        
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @param  int                      $id
         * @return \Illuminate\Http\Response
         */
        public function update($id , Request $request)
        {
            //
            $validator = Validator::make($request->all() ,
                [
                    'title' => 'required|unique:sources,title,'.$id ,
                ]
            );
            $src = Source::find($id);
            $src->title = trim($request->title);
            $src->label = str_slug(trim($request->title) , '_');
            if ($src->save())
            {
                return redirect()->route('source.index')->with('success' , 'Source ' . Config::get('constant.UPDATE_MESSAGE'));
            } else
            {
                return redirect()->route('source.index')->with('err_msg' , Config::get('constant.TRY_MESSAGE'));
            }
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
            $src = Source::find($id);
            if (!empty($src))
            {
                $src->delete($id);
                if ($src->trashed())
                {
                    return redirect()->route('source.index')->with('success' , 'Source ' . Config::get('constant.DELETE_MESSAGE'));
                } else
                {
                    return redirect()->route('source.index')->with('err_msg' , Config::get('constant.TRY_MESSAGE'));
                }
            }
            return redirect()->route('source.index')->with('err_msg' , Config::get('constant.TRY_MESSAGE'));
        }
        
        public function sourceSearch(Request $request)
        {
            $query = '';
    
            if(isset($request->q))
                    $query = $request->q;
    
            $sourcesData = Source::where("title","like" ,"%{$query}%")->latest('created_at')->paginate(50);
            return view("admin.source.index" , compact('sourcesData','query'));
        }
    
        
    }
