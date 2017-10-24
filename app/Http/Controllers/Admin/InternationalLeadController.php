<?php
    
    namespace App\Http\Controllers\Admin;
    
    use App\Currency;
    use App\InternationalLead;
    use App\FollowUp;
    use App\InternationalLeadNote;
    use App\Source;
    use App\User;
    use Carbon\Carbon;
    use Config;
    
    use Exception;
    use Helpers;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Response;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Event;
    use Illuminate\Support\Facades\Redirect;
    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Facades\Validator;
    
    class InternationalLeadController extends Controller
    {
        
        public function __construct()
        {
            $this->middleware(function ($request , $next) {
                if (!Helpers::getCurrentUserDetails('international' , 'true'))
                {
                    return redirect()->to('admin/dashboard');
                }
                
                return $next($request);
            });
        }
        
        /**
         * Display a listing of the resource.
         *
         *
         * @return \Illuminate\Http\Response
         */
        public function index(Request $request)
        {
            
            if (Helpers::getCurrentUserDetails('permissions.view' , 'false' , 'true') == 'FALSE')
            {
                return redirect()->to('admin/dashboard');
            }
            
            
            $count = InternationalLead::count();
            
            if ($count > 0)
            {
                $user = Helpers::getCurrentUserDetails();
//                dd($user);
                
                $role_id = $user->role->id;
                
//                $query = InternationalLead::with(['note' , 'note.noteUser' , 'notesCount' , 'notes' , 'notes.noteUsers' , 'currencies' , 'userDetails']);
                $query = InternationalLead::with(['notes' , 'notes.noteUser' , 'currencies' , 'userDetails']);
                
                if ($role_id == Config::get('constant.EMPLOYEE_ID'))
                {
                    $query = $query->where('user_added_by' , $user->id);
                } else if ($role_id == Config::get('constant.MANAGER_ID'))
                {
                    $uid = User::where('manager_id' , $user->id)->pluck('id')->prepend($user->id);
                    $query = $query->whereIn('user_added_by' , $uid);
                }
                
                $internationalLeads = $query->latest('created_at')->paginate(Config::get('constant.PAGINATION_MIN'));

//                dd($internationalLeads);
                return view("admin.international_leads.index" , compact('internationalLeads'));
            }
            
            return redirect()->route('international.create');

//            $internationalLeads = InternationalLead::all()->paginate(1);
//            dd($internationalLeads);
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
            if (Helpers::getCurrentUserDetails('permissions.add' , 'false' , 'true') == 'FALSE')
            {
                return redirect()->to('admin/dashboard');
            }
            $currencies = Currency::all();
            $follow_list = FollowUp::all();
            $sourceList = Source::all();
            
            return view("admin.international_leads.create" , compact('currencies' , 'follow_list' , 'sourceList'));
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
//            dd($request->lead_comment);
            if (Helpers::getCurrentUserDetails('permissions.add' , 'false' , 'true') == 'FALSE')
            {
                return redirect()->to('admin/dashboard');
            }
            $validator = Validator::make($request->all() ,
                [
                    'project_name' => 'required' ,
                    //                    'currency'     => 'required' ,
                    'source'       => 'required' ,
                    'refer_id'     => 'unique:international_leads' ,
                    //                    'amount'       => 'numeric' ,
                    'email'        => 'email' ,
                    'url'          => 'url' ,
                ]
            );
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $user = Helpers::getCurrentUserDetails();
//            dd($request);
            $lead = new InternationalLead();
            $lead->project_name = $request->project_name;
            $lead->contact_person = $request->contact_person;
            $lead->job_title = $request->job_title;
            $lead->refer_id = $request->refer_id;
            $lead->type = !empty($request->type) ? $request->type : 0;
            $lead->source_id = $request->source;
            $lead->currency = !empty($request->currency) ? $request->currency : 0;
            $lead->amount = !empty($request->amount) ? $request->amount : 0;
            $lead->tags = (count($request->tags) > 0) ? implode("," , $request->tags) : '';
            $lead->comment = trim($request->lead_comment);
            $lead->url = $request->url;
            $lead->location = $request->location;
            $lead->email = !empty($request->email) ? $request->email : '';
            $lead->email_secondary = !empty($request->email_secondary) ? $request->email_secondary : '';
            $lead->status = $request->status;
            $lead->user_added_by = $user->id;
            $lead->skype = $request->skype;
            $lead->phone_number = !empty($request->phone_number) ? $request->phone_number : '';
            $lead->phone_number_secondary = !empty($request->phone_number_secondary) ? $request->phone_number_secondary : '';
            if ($lead->save())
            {
                return redirect()->route('international.edit' , $lead->lead_id)->with('success' , 'Lead ' . Config::get('constant.ADDED_MESSAGE'));
            } else
            { // save failed
                return redirect()->route('international.index')->with('err_msg' , 'International Lead ' . Config::get('constant.TRY_MESSAGE'));
            }
        }
        
        /**
         * Display the specified resource.
         *
         * @param  \App\InternationalLead $internationalLead
         * @return \Illuminate\Http\Response
         */
        public
        function show(InternationalLead $internationalLead)
        {
            //
        }
        
        /**
         * Show the form for editing the specified resource.
         */
        public
        function edit($id)
        {
            //
            
            $currencies = Currency::all();
            $follow_list = FollowUp::all();
            $sourceList = Source::all();
            $leadData = InternationalLead::with(['notes' , 'userDetails' , 'notes.noteUser'])->where('lead_id' , $id)->first();

//            dd($leadData);
            return view('admin.international_leads.edit' , compact('leadData' , 'currencies' , 'follow_list' , 'sourceList'));
        }
        
        
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response
         */
        public
        function update($id , Request $request)
        {
            if (Helpers::getCurrentUserDetails('permissions.update' , 'false' , 'true') == 'FALSE')
            {
                return redirect()->to('admin/dashboard');
            }
//            dd($request);

//            $this->form_validate($request);
//            $validator = Validator::make($request->all() ,
//                [
//                    'project_name' => 'required' ,
//                    'currency'     => 'required' ,
//                    'source'       => 'required' ,
//                    'refer_id'     => 'unique:international_leads,refer_id'.$id ,
////                    'amount'       => "required|numeric|regex:/^\d*(\.\d{2})?$/",
//                    'amount'       => "required|numeric",
//                    'email'        => 'email' ,
//                    'url'          => 'url' ,
//                ]
//            );
//            if ($validator->fails())
//            {
//                return Redirect::back()->withErrors($validator)->withInput();
//            }
            
            $lead = InternationalLead::find($id);

//            $lead->project_name = $request->project_name;
//            $lead->contact_person = $request->contact_person;
//            $lead->job_title = $request->job_title;
//            $lead->refer_id = $request->refer_id;
//            $lead->type = $request->type;
//            $lead->currency = $request->currency;
            $lead->tags = (count($request->tags) > 0) ? implode("," , $request->tags) : '';
//            $lead->source_id = $request->source;
//            $lead->comment = trim($request->lead_comment);
//            $lead->amount = $request->amount;
//            $lead->url = $request->url;
//            $lead->location = $request->location;
//            $lead->email = $request->email;
//            $lead->skype = $request->skype;
//            $lead->phone_number = $request->phone_number;
//            $lead->status = $request->status;
//            $lead->user_added_by = 1;
            if ($lead->save())
            {
                return redirect()->route('international.index')->with('success' , 'International lead ' . Config::get('constant.UPDATE_MESSAGE'));
            } else
            {
                return redirect()->route('international.index')->with('err_msg' , Config::get('constant.TRY_MESSAGE'));
            }
            
            return view('admin.international_leads.update');
        }
        
        /**
         * Remove the specified resource from storage.
         *
         * @return \Illuminate\Http\Response
         */
        public
        function destroy($id)
        {
            //
//            dd($id);
            if (Helpers::getCurrentUserDetails('permissions.delete' , 'false' , 'true') == 'FALSE')
            {
                return redirect()->to('admin/dashboard');
            }
            $lead = InternationalLead::find($id);
            if (!empty($lead))
            {
                $lead->delete($id);
                if ($lead->trashed())
                {
                    return redirect()->route('international.index')->with('success' , 'International Lead' . Config::get('constant.DELETE_MESSAGE'));
                } else
                {
                    return redirect()->route('international.index')->with('err_msg' , Config::get('constant.TRY_MESSAGE'));
                }
            }
            
            return redirect()->route('international.index')->with('err_msg' , Config::get('constant.TRY_MESSAGE'));
        }
        
        
        public
        function ajaxInsert(Request $request)
        {
            $user = Helpers::getCurrentUserDetails();
            $note = new InternationalLeadNote();
            $note->lid = $request->lead_id;
            $note->note_desc = $request->lead_note;
            $note->user_added_by = $user->id;
            $note->user_updated_by = $user->id;
            if ($note->save())
            {
                return response()->json(['note_id' => $note->note_id , 'msg' => 'Note have been created successfully.']);
            } else
            {
                return response()->json(['note_id' => $note->note_id , 'msg' => 'Please try again.']);
            }
            
        }
        
        public
        function ajaxUpdate(Request $request)
        {
            $today = Carbon::now();
            $user = Helpers::getCurrentUserDetails();
            $note = InternationalLeadNote::find($request->note_id);
//            if()
            $created = $note->created_at;
            if (!empty($note) && ($created->diffInSeconds($today) < 86400) && ($note->lid == $request->lead_id))
            {
                // $note->lid = $request->lead_id;
                $note->note_desc = $request->lead_note;
                $note->user_updated_by = $user->id;
                if ($note->save())
                {
                    return response()->json(['msg' => 'Notes have been updated successfully.'] , 200);
                } else
                {
                    return response()->json(['msg' => 'Some error occurred.']);
                }
            } else
            {
                return response()->json(['msg' => 'Update failed.']);
            }
        }
        
        public
        function ajaxDelete(Request $request)
        {
            $today = Carbon::now();
            $note = InternationalLeadNote::find($request->note_id);
            
            
            if ($today->diffInDays($note->created_at) == 0 && !empty($note) && $note->lid == $request->lead_id)
            {
                $note->delete($request->note_id);
                if ($note->trashed())
                {
                    return response()->json(['msg' => 'Note have been deleted successfully.'] , 200);
                } else
                {
                    return response()->json(['msg' => 'Some error occurred.']);
                }
            } else
            {
                return response()->json(['msg' => 'Delete unsuccessful.']);
            }
            
        }
        
        public
        function ajax(Request $request)
        {
            dd("ajax");
        }
        
        public
        function searchLead(Request $request)
        {
            
            if (empty($request->start) && empty($request->end) && empty($request->q))
            {
                return redirect()->back();
            }
            $dateStr = '';
            
            
            $query = '';
            
            if (!empty($request->q))
                $query = $request->q;
//            echo $query;
            
            $q = InternationalLead::with(['note' , 'currencies' , 'userDetails' , 'note.noteUser']);
            if (!empty($request->start) && !empty($request->end))
            {
                $start = new Carbon($request->start);
                $end = new Carbon($request->end);
                $start = $start->toDateTimeString();
                
                $end = $end->addDay()->toDateTimeString();
//                dd($start."--".$end);
//                $q = $q->Where("created_at" , '>=' , $start)->Where('created_at' , '<=' , $end);
                $q = $q->whereBetween('created_at' , [$start , $end]);
                
            }
            if (!empty($request->q))
                $q = $q->where("project_name" , "like" , "%{$query}%")->orWhere("contact_person" , "like" , "%{$query}%")->orWhere("comment" , "like" , "%{$query}%")->orWhere("tags" , "like" , "%{$query}%")->orWhere("job_title" , "like" , "%{$query}%")->orWhere("refer_id" , "like" , "%{$query}%")->orWhere("type" , "like" , "%{$query}%");
            
            $internationalLeads = $q->paginate(Config::get('constant.PAGINATION_MIN'));
//            $internationalLeads = $q->toSql();
//            dd($internationalLeads);
            $end = new Carbon($request->end);
            $end = $end->toDateTimeString();
            
            return view("admin.international_leads.index" , compact('internationalLeads' , 'query' , 'start' , 'end'));
        }
        
    }
