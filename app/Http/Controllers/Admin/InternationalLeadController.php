<?php
    
    namespace App\Http\Controllers\Admin;
    
    use App\Currency;
    use App\InternationalLead;
    use App\FollowUp;
    use App\InternationalLeadNote;
    use App\Source;
    use Carbon\Carbon;
    use Config;
    
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Response;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Redirect;
    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Facades\Validator;
    
    class InternationalLeadController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         *
         * @return \Illuminate\Http\Response
         */
        public function index(Request $request)
        {
            $count = InternationalLead::count();
            if ($count > 0)
            {
                $internationalLeads = InternationalLead::with(['note' , 'currencies'])->latest('created_at')->paginate(50);
//                dd($internationalLeads);
//                foreach ($internationalLeads as $lead)
//                {
//                    echo "<pre>"; print_r($lead);
//                }
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
        public function create()
        {
            //
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
        public function store(Request $request)
        {
//            dd($request->lead_comment);
            $validator = Validator::make($request->all() ,
                [
                    'project_name' => 'required' ,
                    'currency'     => 'required' ,
                    'source'       => 'required' ,
                    'refer_id'     => 'unique:international_leads',
                    'amount'       => 'numeric',
                    'email'        => 'email' ,
                    'url'          => 'url' ,
                ]
            );
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            
//            dd($request);
            $lead = new InternationalLead();
            $lead->project_name = $request->project_name;
            $lead->contact_person = $request->contact_person;
            $lead->job_title = $request->job_title;
            $lead->refer_id = $request->refer_id;
            $lead->type = !empty($request->type) ? $request->type : 0;
            $lead->source_id = $request->source;
            $lead->currency = !empty($request->currency)?$request->currency:0;
            $lead->amount = !empty($request->amount)?$request->amount:0;
            $lead->tags = ( count($request->tags) > 0 ) ? implode("," , $request->tags) : '';
            $lead->comment = trim($request->lead_comment);
            $lead->url = $request->url;
            $lead->location = $request->location;
            $lead->email = $request->email;
            $lead->status = $request->status;
            $lead->user_added_by = 1;
            $lead->skype = $request->skype;
            $lead->phone_number = !empty($request->phone_number)?$request->phone_number:'';
            if ($lead->save())
            {
                return redirect()->route('international.index')->with('success' , 'International Lead ' . Config::get('constant.ADDED_MESSAGE'));
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
        public function show(InternationalLead $internationalLead)
        {
            //
        }
        
        /**
         * Show the form for editing the specified resource.
         */
        public function edit($id)
        {
            //
            
            $currencies = Currency::all();
            $follow_list = FollowUp::all();
            $sourceList = Source::all();
            $leadData = InternationalLead::with('notes')->where('lead_id' , $id)->first();

//            dd($leadData);
            return view('admin.international_leads.edit' , compact('leadData' , 'currencies' , 'follow_list' , 'sourceList'));
        }
        
        
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response
         */
        public function update($id , Request $request)
        {

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
            $lead->tags = ( count($request->tags) > 0 ) ? implode("," , $request->tags) : '';
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
        public function destroy($id)
        {
            //
//            dd($id);
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
        
        
        public function ajaxInsert(Request $request)
        {
            $note = new InternationalLeadNote();
            $note->lid = $request->lead_id;
            $note->note_desc = $request->lead_note;
            if ($note->save())
            {
                return response()->json(['note_id' => $note->note_id , 'msg' => 'Note have been created successfully.']);
            } else
            {
                return response()->json(['note_id' => $note->note_id , 'msg' => 'Please try again.']);
            }
            
        }
        
        public function ajaxUpdate(Request $request)
        {
            $today = Carbon::now();
            $note = InternationalLeadNote::find($request->note_id);
//            if()
            if ((!empty($note) && $today->diffInDays($note->created_at) == 0) && ($note->lid == $request->lead_id))
            {
                // $note->lid = $request->lead_id;
                $note->note_desc = $request->lead_note;
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
        
        public function ajaxDelete(Request $request)
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
        
        public function ajax(Request $request)
        {
            dd("ajax");
        }
        
        public function searchLead(Request $request)
        {
            $query = '';
            
            if (isset($request->q))
                $query = $request->q;
//            echo $query;
            
            $internationalLeads = InternationalLead::with(['note' , 'currencies'])->where("project_name" , "like" , "%{$query}%")->orWhere("contact_person" , "like" , "%{$query}%")->orWhere("comment" , "like" , "%{$query}%")->orWhere("tags" , "like" , "%{$query}%")->orWhere("job_title" , "like" , "%{$query}%")->orWhere("refer_id" , "like" , "%{$query}%")->orWhere("type" , "like" , "%{$query}%")->paginate(50);
            
            return view("admin.international_leads.index" , compact('internationalLeads' , 'query'));
        }
        
    }
