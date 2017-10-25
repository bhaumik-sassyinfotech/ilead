<?php
    
    use App\User;
    use App\Meta;
    use Carbon\Carbon;

//use DB;
    
    class Helpers
    {
        
        public static function getemplprofile()
        {
            //$email = Auth::user()->email;
            //$name = Auth::user()->name;
            $id = Auth::guard('admin')->user()->id;
            $user = User::findOrFail($id);
            $data = array();
            $data['name'] = $user->fullname . ' ' . $user->lastname;
            $data['email'] = $user->email;
            $data['profile_pic'] = $user->profile_pic;
            $data['id'] = $id;
            
            return $data;
        }
        
        public static function isAdmin()
        {
            if (Auth::guard('admin')->check()) {
                if (Auth::guard('admin')->user()->is_admin == 1) {
                    return Auth::guard('admin')->user()->role_id;
                }
                throw new Exception('Please admin login first.');
            }
        }
        
        public static function getAdminSetting($key = null)
        {
            if ($key != null) {
                $key = DB::table('settings')->select('value')->where('key', $key)->first();
                if (!is_object($key)) {
                    return "";
                }
                
                return $key->value;
            }
            throw new Exception('Block identifier not define');
        }
        
        public static function getAdminPermission($key = null, $id = null)
        {
            
            if ($key != null) {
                if (is_null($id)) {
                    $id = Auth::guard('admin')->user()->role_id;
                }
                $my_val = DB::table('roles')->select('permissions')->where('id', $id)->first();
                $my_val = json_decode($my_val->permissions, TRUE);
                //echo $my_val[$key]; die;
                if (is_array($my_val)) {
                    if (isset($my_val[$key]) && $my_val[$key] != '') {
                        return $my_val[$key];
                    } else {
                        return 'false';
                    }
                }
                throw new Exception('User permission not define');
            }
        }
        
        public static function getmeta()
        {
            $url = $_SERVER['REQUEST_URI'];
            $meta = DB::table('metas')->select('*')->where('url', $url)->first();
            
            if (!is_object($meta)) {
                $request = request();
                $segment1 = $request->segment(1);
                $meta = DB::table('cms')->where('keyword', $segment1)->where('deleted_at', null)->get()->first();
                
                
                if (!is_object($meta)) {
                    $meta = new stdClass();
                    $meta->meta_keyword = 'Sassy CRM Default keyword';
                    $meta->meta_title = 'Sassy CRM Default title';
                    $meta->meta_description = 'Sassy CRM Default description';
                    $meta->website_title = 'Sassy CRM Default website title';
                }
            }
            
            return $meta;
        }
        
        public function notification($identifier = null)
        {
            if ($identifier != null) {
                $identifier = DB::table('notifications')->select('*')->where('identifier', $identifier)->first();
                if (!is_object($identifier)) {
                    $identifier = new stdClass();
                }
            }
            
            return $identifier;
        }
        
        public function getNotification($identifier = null)
        {
            if ($identifier != null) {
                $identifier = DB::table('notifications')->select('*')->where('identifier', $identifier)->first();
                if (!is_object($identifier)) {
                    $identifier = new stdClass();
                }
                
                return $identifier;
            }
            throw new Exception('Notification identifier not define');
        }
        
        public function getMessages($identifier = null)
        {
            if ($identifier != null) {
                $identifier = DB::table('messages')->select('*')->where('identifier', $identifier)->first();
                if (!is_object($identifier)) {
                    $identifier = new stdClass();
                }
                
                return $identifier;
            }
            throw new Exception('Messages identifier not define');
        }
        
        public function getBlock($identifier = null)
        {
            if ($identifier != null) {
                $identifier = DB::table('blocks')->select('*')->where('identifier', $identifier)->first();
                if (!is_object($identifier)) {
                    $identifier = new stdClass();
                }
                
                return $identifier;
            }
            throw new Exception('Block identifier not define');
        }
        
        public static function checkLogin()
        {
            if (Auth::check()) {
                $login = 1;
            } else {
                $login = 0;
            }
            
            return $login;
        }
        
        public static function getCmsBlock($keyword = null)
        {
            
            if ($keyword != null) {
                $keyword = DB::table('blocks')->select('content')->where('identifier', $keyword)->first();
                if (is_null($keyword)) {
                    return FALSE;
                }
                
                return $keyword->content;
            }
            throw new Exception('Blocks identifier not define');
        }
        
        public static function replaceStaticBlock($keyword = null)
        {
            
            
            if ($keyword != null) {
                
                $fillData = array();
                preg_match_all('/{{(.*?)}}/', $keyword, $matches);
                if (is_null($matches)) {
                    return $keyword;
                }
                
                foreach ($matches[1] as $key => $val) {
                    $fillData[$val] = self::getCmsBlock($val);
                }
                
                return $desc = self::parseTemplate($keyword, $fillData);
            }
            throw new Exception('Block identifier not define');
        }
        
        public static function parseTemplate($template, $data)
        {
            if ($template == '') {
                return FALSE;
            }
            $l_delim = '{{';
            $r_delim = '}}';
            foreach ($data as $key => $val) {
                if (!is_array($val)) {
                    $template = str_replace($l_delim . $key . $r_delim, (string)$val, $template);
                }
            }
            
            return $template;
        }
        public static function getCurrentUserDetails($field = '' , $module = 'false' , $role='false')
        {
            
            //$email = Auth::user()->email;
            //$name = Auth::user()->name;
    
            $data = Auth::guard('admin')->user();
            $roleID = $data->role_id;
            
            $user = User::with(['role' => function($query) use ($roleID){}])->where('users.id',$data->id)->first();
//            dd($user);
            if( !empty($field) )
            {
                if(strtolower($role) == 'true' && strtolower($module) == 'false')
                {
                    $exp = explode("." , $field);
                    
//                    return $user->role->$field === 'TRUE' ? TRUE : FALSE;
                    if($exp[0] == 'permissions' && key_exists(1,$exp))
                    {
                        $temp = $exp[1];
                        $perm = json_decode($user->role->permissions);
                        return $perm->$temp;
                    }else
                    {
                        return $user->role->$field;
                    }
                } else if(strtolower($module) == 'true' && strtolower($role) == 'false')
                {
                    $mod = json_decode($user->module);
//                    dd($mod);
                    return $mod->$field === 'TRUE' ? TRUE : FALSE;
                }
                return $user->$field;
            }
            return $user;
        }
        
        public static function custom_date_format($date)
        {
            $date = new Carbon($date);
            return $date->format(Config::get('constant.DATETIME_FORMAT'));
        }
        
        
        
        
    }

?>