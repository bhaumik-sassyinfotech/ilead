<?php
    
    namespace App\Http\Controllers\Admin;
    
    use App\Role;
    use App\User;
    use Illuminate\Http\Request;
    use App\Http\Requests\StoreRolesRequest;
    use App\Http\Requests\UpdateRolesRequest;
    use DB;
    use Helpers;
    use Config;
    use App\Http\Controllers\Admin\AdminController;
    use phpDocumentor\Reflection\Types\Null_;

    class RolesController extends AdminController
    {
        
        public function __construct(Request $request)
        {
            $this->setSearchArray(array(0 => 'title'));
            $this->setFormValidator($request , [
                'title' => 'required' ,
            ]);
            $this->middleware(function ($request , $next) {
                if (Helpers::isAdmin() != 1)
                {
                    return redirect()->to('admin/dashboard');
                }
                return $next($request);
            });
            
            
        }
        
        /**
         * Display a listing of Role.
         *
         * @return \Illuminate\Http\Response
         */
        public function index(Request $request)
        {
            $roles = Role::whereNull('deleted_at')->paginate(5);
            $placeholder_string = $this->getSearchPlaceholder();
            
            return view('admin.roles.index' , compact('roles' , 'placeholder_string'));
        }
        
        /**
         * Show the form for creating new Role.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
//        dd("hji");
            return view('admin.roles.create');
        }
        
        /**
         * Store a newly created Role in storage.
         *
         * @param  \App\Http\Requests\StoreRolesRequest $request
         * @return \Illuminate\Http\Response
         */
        public function store(StoreRolesRequest $request)
        {
            if (!is_null($return = $this->checkValidation()))
                return $return;
            $role = new Role;
            $role->title = $request->input('title');
            $role->status = $request->input('status');
            $role->permissions = $this->jsonEncode($request);
            $role->save();
            
            return redirect()->route('roles.index')->with('success' , 'Role ' . Config::get('constant.ADDED_MESSAGE'));
        }
        
        /**
         * Show the form for editing Role.
         *
         * @param  int $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $role = Role::findOrFail($id);
            $role->permissions = $this->jsonDecode($role);
            
            return view('admin.roles.edit' , compact('role'));
        }
        
        /**
         * Update Role in storage.
         *
         * @param  \App\Http\Requests\UpdateRolesRequest $request
         * @param  int                                   $id
         * @return \Illuminate\Http\Response
         */
        public function update(UpdateRolesRequest $request , $id)
        {
            if (!is_null($return = $this->checkValidation()))
                return $return;
            $role = Role::findOrFail($id);
            $role->title = $request->input('title');
            $role->status = $request->input('status');
            $role->permissions = $this->jsonEncode($request);
            $role->save();
            
            return redirect()->route('roles.index')->with('success' , 'Role ' . Config::get('constant.UPDATE_MESSAGE'));
        }
        
        /**
         * Display Role.
         *
         * @param  int $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            $role = Role::findOrFail($id);
            
            return view('admin.roles.show' , compact('role'));
        }
        
        /**
         * Remove Role from storage.
         *
         * @param  int $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            $users = DB::table('users')->where('role_id' , $id)->exists();
            if ($users)
            {
                return redirect()->route('roles.index')->with('err_msg' , Config::get('constant.NOT_DELETE'));
            }
            $role = Role::findOrFail($id);
            $role->forceDelete();
            
            return redirect()->route('roles.index')->with('success' , 'Role ' . Config::get('constant.DELETE_MESSAGE'));
        }
        
        /**
         * Delete all selected Role at once.
         *
         * @param Request $request
         */
        public function massDestroy(Request $request)
        {
            if ($request->input('ids'))
            {
                $ids = $request->input('ids');
                $sucess = DB::table("roles")->whereIn('id' , explode("," , $ids))->delete();
                
                return response()->json(['success' => "Roles Deleted successfully."]);
            }
        }
        
        /**
         * Json Encode.
         *
         * @param Request $request
         */
        public function jsonEncode($data)
        {
            $per_array = [
                'add'    => $data->input('add') ? 'TRUE' : 'FALSE' ,
                'delete' => $data->input('delete') ? 'TRUE' : 'FALSE' ,
                'view'   => $data->input('view') ? 'TRUE' : 'FALSE' ,
                'update' => $data->input('update') ? 'TRUE' : 'FALSE' ,
                //            'transaction.manage' => $data->input('transManage') ? 'true' : 'false',
                //            'transaction.view' => $data->input('transView') ? 'true' : 'false',
                //            'transaction.delete' => $data->input('transDelete') ? 'true' : 'false',
                //            'faq.manage' => $data->input('faqManage') ? 'true' : 'false',
                //            'faq.view' => $data->input('faqView') ? 'true' : 'false',
                //            'faq.delete' => $data->input('faqDelete') ? 'true' : 'false',
            ];
            
            return json_encode($per_array);
        }
        
        /**
         * Json Decode.
         *
         * @param Request $request
         */
        public function jsonDecode($data)
        {
            return json_decode($data->permissions , TRUE);
        }
        
        /**
         * Search Records.
         *
         * @param Request $request
         */
        public function searchRoles(Request $request)
        {
            if (empty($request->input('q')))
                return redirect()->route('users.index');
            $q = $request->input('q');
            
            $placeholder_string = $this->getSearchPlaceholder();
            $roles = DB::table('roles')->whereNull('deleted_at')->selectRaw('*')->whereRaw($this->createSearchQuery($q))->paginate(5);
            
            
            $pagination = $roles->appends(array('q' => $q));
            
            return view('admin.roles.index' , compact('roles' , 'q' , 'placeholder_string'));
        }
        
    }
