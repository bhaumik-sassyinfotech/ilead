<?php
    
    namespace App\Http\Controllers\Admin;
    
    use Auth;
    use App\User;
    use Illuminate\Http\Request;
    use App\Http\Requests\StoreUsersRequest;
    use App\Http\Requests\UpdateUsersRequest;
    use App\Http\Controllers\Traits\FileUploadTrait;
    use Image;
    use Config;
    use Helpers;
    use DB;
    use App\Http\Controllers\Admin\AdminController;
    
    class UsersController extends AdminController
    {
        
        use FileUploadTrait;
        
        public function __construct(Request $request)
        {
            $this->setSearchArray(array(0 => 'fullname' , 1 => 'email'));
            $this->setFormValidator($request , [
                'fullname'    => 'required' ,
                'lastname'    => 'required' ,
                'email'       => 'required|email|unique:users,email' , //'.$this->route('user'),
                'role_id'     => 'required' ,
                'profile_pic' => 'image|mimes:jpg,jpeg,bmp,png' ,
            ]);
            
            $this->middleware(function ($request , $next) {
                // if(\Auth::user()->role_id != 1){
                //     return abort(404);
                // }
                if (Helpers::isAdmin() != 1)
                {
                    return redirect()->to('admin/dashboard');
                }
                return $next($request);
            });
            
        }
        
        /**
         * Display a listing of User.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
//            dd(Helpers::isAdmin());
            $users = User::whereNull('deleted_at')->paginate(5);
            $placeholder_string = $this->getSearchPlaceholder();
            
            return view('admin.users.index' , compact('users' , 'placeholder_string'));
        }
        
        public function userSearch(Request $request)
        {
            if (empty($request->input('q')))
                return redirect()->route('users.index');
            $q = $request->input('q');
            
            $placeholder_string = $this->getSearchPlaceholder();
            $users = DB::table('users')->whereNull('deleted_at')->selectRaw('*')->whereRaw($this->createSearchQuery($q))->paginate(5);
            
            
            $pagination = $users->appends(array('q' => $q));
            
            return view('admin.users.index' , compact('users' , 'q' , 'placeholder_string'));
        }
        
        public function destroy($id)
        {
            $user = User::findOrFail($id);
            $user->forceDelete();
            
            return redirect()->route('users.index')->with('success' , 'User ' . Config::get('constant.constant.DELETE_MESSAGE'));
        }
        
        /**
         * Show the form for creating new User.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            if (Helpers::isAdmin() != 1)
            {
                return redirect()->to('admin/dashboard');
            }
            
//            dd(User::where('role_id',Config::get('constant.MANAGER_ID'))->get());
            $relations = [
                'roles' => \App\Role::get()->pluck('title' , 'id')->prepend('Please select' , '') ,
                'managers' => User::where('role_id',Config::get('constant.MANAGER_ID'))->get()
            ];
//            dd($relations);
            return view('admin.users.create' , $relations);
        }
        
        /**
         * Store a newly created User in storage.
         *
         * @param  \App\Http\Requests\StoreUsersRequest $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            
            
            if (Helpers::isAdmin() != 1)
            {
                return redirect()->to('admin/dashboard');
            }
            if (!is_null($return = $this->checkValidation()))
                return $return;
//        dd($request->all());
            //  return $request->role_id; die;
            
            $file = $request->file('profile_pic');
            if ($file != "")
            {
                $ext = $file->getClientOriginalExtension();
                $fileName = rand(10000 , 50000) . '.' . $ext;
                $image = Image::make($request->file('profile_pic'));
                $image->resize(120 , 120);
                $image->save(base_path() . '/public/uploads/profile_pic/' . $fileName);
            }
            $request->daily_target = (int) $request->daily_target;
            $moduleArr = [
                'international' => $request->international ? 'TRUE' : 'FALSE' ,
                'cold'          => $request->cold ? 'TRUE' : 'FALSE' ,
                'local'         => $request->local ? 'TRUE' : 'FALSE' ,
            ];
            $request['module'] = json_encode($moduleArr);
            if($request->international)
                unset($request['international']);
            if($request->local)
                unset($request['local']);
            if($request->cold)
                unset($request['cold']);
            if($request->role_id == Config::get('constant.EMPLOYEE_ID'))
            {
                if($request->manager == 0)
                    return \Redirect::back()->withInput();
            }else {
                $request->manager = 0;
            }
            $request = $this->saveFiles($request);
            
            
//            unset($request['cold']);
            
            $users = User::create($request->all());
            
            if ($file != "")
            {
                $user = User::findOrFail($users->id);
                $user->profile_pic = $fileName;
                $user->save();
            }
            
            return redirect()->route('users.index')->with('success' , 'User ' . Config::get('constant.ADDED_MESSAGE'));
        }
        
        /**
         * Show the form for editing User.
         *
         * @param  int $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            if (Helpers::isAdmin() != 1)
            {
                return redirect()->to('admin/dashboard');
            }
            $relations = [
                'roles' => \App\Role::get()->pluck('title' , 'id')->prepend('Please select' , '') ,
            ];
            
            $user = User::findOrFail($id);
//             dd($user);
            //dd(Auth::guard('admin')->user()->id);
            $auth_id = Auth::guard('admin')->user()->id;
            if ($auth_id == $id)
            {
                return view('admin.users.myprofile' , compact('user') + $relations);
            } else
            {
                return view('admin.users.edit' , compact('user') + $relations);
            }
        }
        
        public function myprofile($id)
        {
            
            $relations = [
                'roles' => \App\Role::get()->pluck('title' , 'id')->prepend('Please select' , '') ,
            ];
            
            $user = User::findOrFail($id);
            
            return view('admin.users.myprofile' , compact('user') + $relations);
        }
        
        public function myprofile_update(UpdateUsersRequest $request , $id)
        {
            $user = User::findOrFail($id);
            $user->update($request->all());
            
            return redirect()->route('home.index')->with('success' , 'User ' . Config::get('constant.UPDATE_MESSAGE'));
        }
        
        /**
         * Update User in storage.
         *
         * @param  \App\Http\Requests\UpdateUsersRequest $request
         * @param  int                                   $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request , $id)
        {
            if (Helpers::isAdmin() != 1)
            {
                return redirect()->to('admin/dashboard');
            }
            $this->setFormValidator($request , [
                'fullname'    => 'required' ,
                'lastname'    => 'required' ,
                'email'       => 'required' , //'.$this->route('user'),
                'role_id'     => 'required' ,
                'profile_pic' => 'image|mimes:jpg,jpeg,bmp,png' ,
            ]);
            if (!is_null($return = $this->checkValidation()))
                return $return;
            $user = User::findOrFail($id);
            $moduleArr = [
                'international' => $request->international ? 'TRUE' : 'FALSE' ,
                'cold'          => $request->cold ? 'TRUE' : 'FALSE' ,
                'local'         => $request->local ? 'TRUE' : 'FALSE' ,
            ];
            $request['module'] = json_encode($moduleArr);
//            dd($request);
            if($request->international)
                unset($request['international']);
            if($request->local)
                unset($request['local']);
            if($request->cold)
                unset($request['cold']);
            
            $user->update($request->all());
            
            $file = $request->file('profile_pic');
            if ($file != "")
            {
                $ext = $file->getClientOriginalExtension();
                $fileName = rand(10000 , 50000) . '.' . $ext;
                $image = Image::make($request->file('profile_pic'));
                $image->resize(120 , 120);
                $image->save(base_path() . '/public/uploads/profile_pic/' . $fileName);
                $user = User::findOrFail($id);
                $user->profile_pic = $fileName;
                $user->save();
            }
            
            return redirect()->route('users.index')->with('success' , 'User ' . Config::get('constant.constant.UPDATE_MESSAGE'));
        }
        
        /**
         * Display User.
         *
         * @param  int $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            $relations = [
                'roles' => \App\Role::get()->pluck('title' , 'id')->prepend('Please select' , '') ,
            ];
            
            $user = User::findOrFail($id);
            
            return view('admin.users.show' , compact('user') + $relations);
        }
        
        /**
         * Remove User from storage.
         *
         * @param  int $id
         * @return \Illuminate\Http\Response
         */
        
        /**
         * Delete all selected User at once.
         *
         * @param Request $request
         */
        public function massDestroy(Request $request)
        {
            if ($request->input('ids'))
            {
                $entries = User::whereIn('id' , $request->input('ids'))->get();
                
                foreach ($entries as $entry)
                {
                    $entry->delete();
                }
            }
        }
        
    }
