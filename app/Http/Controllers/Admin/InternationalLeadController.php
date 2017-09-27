<?php
    
    namespace App\Http\Controllers\Admin;
    
    use App\Currency;
    use App\InternationalLead;
    use App\internationalLeadComment;
    use App\FollowUp;
    use App\InternationalLeadNote;
    use Carbon\Carbon;
    use Config;
    use function foo\func;
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
        public function index()
        {
            
            $internationalLeads = InternationalLead::with('latestComment')->latest('updated_at')->paginate(1);
            
            return view("admin.international_leads.index" , compact('internationalLeads'));
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
            
            return view("admin.international_leads.create" , compact('currencies' , 'follow_list'));
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
            $this->form_validate($request);
            
            $lead = new InternationalLead();
            $lead->project_name = $request->project_name;
            $lead->contact_person = $request->contact_person;
            $lead->job_title = $request->job_title;
            $lead->refer_id = $request->refer_id;
            $lead->type = $request->type;
            $lead->currency = $request->currency;
            $lead->currency = $request->currency;
            $lead->amount = $request->amount;
            $lead->url = $request->url;
            $lead->location = $request->location;
            $lead->email = $request->email;
            $lead->skype = $request->skype;
            $lead->phone_number = $request->phone_number;
            if ($lead->save())
            {
                $comment = new internationalLeadComment();
                $comment->lid = $lead->lead_id;
                $comment->lead_comment = trim($request->lead_comment);
                if ($comment->save())
                {
                    return redirect()->route('international.index')->with('success' , 'International Lead ' . Config::get('constant.ADDED_MESSAGE'));
                } else
                {//save failed
//                    return redirect()->route('international.index')->with('err_msg' , 'International Lead ' . Config::get('constant.TRY_MESSAGE'));
                    return redirect()->route('international.index')->with('err_msg' , 'International Lead ' . Config::get('constant.TRY_MESSAGE'));
                }
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
            
            $leadData = InternationalLead::with(['latestComment' , 'notes'])->where('lead_id' , $id)->first();


//            dd($leadData);
            return view('admin.international_leads.edit' , compact('leadData' , 'currencies' , 'follow_list'));
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
            
            $lead = InternationalLead::find($id);
            
            $lead->project_name = $request->project_name;
            $lead->contact_person = $request->contact_person;
            $lead->job_title = $request->job_title;
            $lead->refer_id = $request->refer_id;
            $lead->type = $request->type;
            $lead->currency = $request->currency;
            $lead->currency = $request->currency;
            $lead->amount = $request->amount;
            $lead->url = $request->url;
            $lead->location = $request->location;
            $lead->email = $request->email;
            $lead->skype = $request->skype;
            $lead->phone_number = $request->phone_number;
            if ($lead->save())
            {
//                $comment = new internationalLeadComment();
                $comment = internationalLeadComment::where('lid' , $lead->lead_id)->first();
                if (empty($comment) && count($comment) < 1)
                {
                    $comment = new internationalLeadComment();
                    $comment->lid = $lead->lead_id;
                }
                $comment->lead_comment = trim($request->lead_comment);
                if ($comment->save())
                {
                    return redirect()->route('international.index')->with('success' , 'International lead ' . Config::get('constant.UPDATE_MESSAGE'));
                } else
                {
                    
                    return redirect()->route('international.index')->with('err_msg' , Config::get('constant.TRY_MESSAGE'));
                }
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
                    return redirect()->route('international.index')->with('success' , 'Follow up ' . Config::get('constant.DELETE_MESSAGE'));
                } else
                {
                    return redirect()->route('international.index')->with('err_msg' , 'Follow up ' . Config::get('constant.TRY_MESSAGE'));
                }
            }
            
            return redirect()->route('international.index')->with('err_msg' , Config::get('constant.TRY_MESSAGE'));
        }
        
        
        public function form_validate(Request $request)
        {
            $validator = Validator::make($request->all() ,
                [
                    'project_name' => 'required' ,
                    'currency'     => 'required' ,
                    'amount'       => "required|numeric|regex:/^\d*(\.\d{2})?$/" ,
                    'email'        => 'email' ,
                    'url'          => 'url' ,
                ]
            );
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            
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
            if (!empty($note) && $today->diffInDays($note->created_at) == 0 && $note->lid == $request->lead_id)
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
        
    }
