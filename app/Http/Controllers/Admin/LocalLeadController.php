<?php
    
    namespace App\Http\Controllers\Admin;
    
    use App\Currency;
    use App\FollowUp;
    use App\InternationalLead;
    use App\LocalLead;
    use App\LocalLeadNote;
    use App\Source;
    use Carbon\Carbon;
    use Config;
    use Helpers;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Response;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Redirect;
    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Facades\Validator;
    use Excel;
    use Yajra\Datatables\Facades\Datatables;
    
    class LocalLeadController extends Controller
    {
        public function __construct()
        {
            $this->middleware(function ($request, $next)
            {
                if (!Helpers::getCurrentUserDetails('international', 'true'))
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
//            dd(LocalLead::Find(4));
            $count = LocalLead::count();
            if ($count > 0)
            {
                $localLeads = LocalLead::with(['note', 'currencies'])->latest('created_at')->paginate(50);

//                dd($internationalLeads);
                
                return view("admin.local_leads.index1", compact('localLeads'));
            }
            
            return redirect()->route('local.create');
        }
        
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            //
            $currencies  = Currency::all();
            $follow_list = FollowUp::all();
            $sourceList  = Source::all();
            
            return view("admin.local_leads.create", compact('currencies', 'follow_list', 'sourceList'));
        }
        
        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
//            dd($request->lead_comment);
//            $validator = Validator::make($request->all() ,
//                [
//                    'company_name' => 'required' ,
//                    'currency'     => 'required' ,
//                    'amount'       => "required|numeric|regex:/^\d*(\.\d{2})?$/" ,
//                    'email'        => 'email' ,
//                    'url'          => 'url' ,
//                ]
//            );
//            if ($validator->fails())
//            {
//                return Redirect::back()->withErrors($validator)->withInput();
//            }
            
            $user                 = Helpers::getCurrentUserDetails();
            $lead                 = new LocalLead();
            $lead->company_name   = $request->company_name;
            $lead->contact_person = $request->contact_person;
            $lead->job_title      = $request->job_title;
            $lead->refer_id       = $request->refer_id;
            $lead->type           = !empty($request->type) ? $request->type : 0;
            $lead->source_id      = $request->source;
            $lead->currency       = !empty($request->currency) ? $request->currency : 0;
//            $lead->amount = !empty($request->amount) ? $request->amount : 0;
            $lead->amount         = !empty($request->amount) ? $request->amount : 0;
            $lead->user_added_by  = $user->id;
            $lead->tags           = (count($request->tags) > 0) ? implode(",", $request->tags) : '';
            $lead->comment        = trim($request->lead_comment);
            $lead->address        = trim($request->lead_address);
            $lead->url            = $request->url;
            $lead->status         = $request->status;
            $lead->email          = $request->email;
            $lead->industry       = $request->industry;
            $lead->phone_number_1 = $request->phone_number_1;
            $lead->phone_number_2 = $request->phone_number_2;
            if ($lead->save())
            {
//                dd("saved");
                return redirect()->route('local.index')->with('success', 'Local Lead ' . Config::get('constant.ADDED_MESSAGE'));
            } else
            { // save failed
//                dd("fail");
                return redirect()->route('local.index')->with('err_msg', 'Local Lead ' . Config::get('constant.TRY_MESSAGE'));
            }
        }
        
        /**
         * Display the specified resource.
         *
         * @param  \App\InternationalLead $internationalLead
         *
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
            
            $currencies  = Currency::all();
            $follow_list = FollowUp::all();
            $sourceList  = Source::all();
            $leadData    = LocalLead::with('notes')->where('lead_id', $id)->first();

//            dd($leadData);
            return view('admin.local_leads.edit', compact('leadData', 'currencies', 'follow_list', 'sourceList'));
        }
        
        
        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Http\Response
         */
        public function update($id, Request $request)
        {

//            dd($request);

//            $this->form_validate($request);
            $validator = Validator::make($request->all(),
                                         [
//                    'company_name' => 'required' ,
//                    'currency'     => 'required' ,
'email' => 'email',
'url'   => 'url',
                ]
            );
            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            
            $lead = LocalLead::find($id);

//            $lead->company_name = $request->company_name;
//            $lead->contact_person = $request->contact_person;
//            $lead->job_title = $request->job_title;
//            $lead->refer_id = $request->refer_id;
//            $lead->type = !empty($request->type) ? $request->type : 0;
//            $lead->source_id = $request->source;
//            $lead->currency = !empty($request->currency) ? $request->currency : 0;
//            $lead->amount = $request->amount;
            $lead->tags = (count($request->tags) > 0) ? implode(",", $request->tags) : '';
//            $lead->comment = trim($request->lead_comment);
//            $lead->address = trim($request->lead_address);
//            $lead->url = $request->url;
//            $lead->status = $request->status;
//            $lead->email = $request->email;
//            $lead->industry = $request->industry;
//            $lead->phone_number_1 = $request->phone_number_1;
//            $lead->phone_number_2 = $request->phone_number_2;
            if ($lead->save())
            {
                return redirect()->route('local.index')->with('success', 'Local lead ' . Config::get('constant.UPDATE_MESSAGE'));
            } else
            {
                return redirect()->route('local.index')->with('err_msg', Config::get('constant.TRY_MESSAGE'));
            }
            
            return view('admin.local_leads.update');
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
            $lead = LocalLead::find($id);
            if (!empty($lead))
            {
                $lead->delete($id);
                if ($lead->trashed())
                {
                    return redirect()->route('local.index')->with('success', 'Local Lead ' . Config::get('constant.DELETE_MESSAGE'));
                } else
                {
                    return redirect()->route('local.index')->with('err_msg', Config::get('constant.TRY_MESSAGE'));
                }
            }
            
            return redirect()->route('local.index')->with('err_msg', Config::get('constant.TRY_MESSAGE'));
        }


//        public function form_validate(Request $request)
//        {
//            $validator = Validator::make($request->all() ,
//                [
//                    'project_name' => 'required' ,
//                    'currency'     => 'required' ,
//                    'amount'       => "required|numeric|regex:/^\d*(\.\d{2})?$/" ,
//                    'email'        => 'email' ,
//                    'url'          => 'url' ,
//                ]
//            );
//            if ($validator->fails())
//            {
//                return Redirect::back()->withErrors($validator)->withInput();
//            }
//
//        }
        
        public function ajaxInsert(Request $request)
        {
            $note            = new LocalLeadNote();
            $note->lid       = $request->lead_id;
            $note->note_desc = $request->lead_note;
            if ($note->save())
            {
                return response()->json(['note_id' => $note->note_id, 'msg' => 'Note have been created successfully.']);
            } else
            {
                return response()->json(['note_id' => $note->note_id, 'msg' => 'Please try again.']);
            }
            
        }
        
        public function ajaxUpdate(Request $request)
        {
            $today = Carbon::now();
            $note  = LocalLeadNote::find($request->note_id);
//            if()
            if ((!empty($note) && $today->diffInDays($note->created_at) == 0) && ($note->lid == $request->lead_id))
            {
                // $note->lid = $request->lead_id;
                $note->note_desc = $request->lead_note;
                if ($note->save())
                {
                    return response()->json(['msg' => 'Notes have been updated successfully.'], 200);
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
            $note  = LocalLeadNote::find($request->note_id);
            
            
            if ($today->diffInDays($note->created_at) == 0 && !empty($note) && $note->lid == $request->lead_id)
            {
                $note->delete($request->note_id);
                if ($note->trashed())
                {
                    return response()->json(['msg' => 'Note have been deleted successfully.'], 200);
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
            {
                $query = $request->q;
            }
//            echo $query;
            
            $localLeads = LocalLead::with('note')->where("company_name", "like", "%{$query}%")->orWhere("contact_person", "like", "%{$query}%")->orWhere("comment", "like", "%{$query}%")->orWhere("tags", "like", "%{$query}%")->orWhere("job_title", "like", "%{$query}%")->orWhere("refer_id", "like", "%{$query}%")->orWhere("type", "like", "%{$query}%")->paginate(50);
            
            return view("admin.local_leads.index", compact('localLeads', 'query'));
        }
        
        
        public function importFile()
        {
            
            $data = [];
            $user = Helpers::getCurrentUserDetails();
            $url  = 'public/uploads/z.xlsx';
//            $data = Excel::load($url)->get();
            $sheetData = Excel::load($url)->toArray();
            
            $user = Helpers::getCurrentUserDetails();
            $id   = $user->id;
            if (!empty($sheetData))
            {
                
                foreach ($sheetData as $sheet => $rows)
                {
                    
                    if (!empty($rows))
                    {
                        $data = [];
                        foreach ($rows as $key => $row)
                        {
                            if (!empty($row))
                            {
                                $now    = date('Y-m-d H:i:s');
                                $data[] =
                                    [
                                        'import_type' => 1, 'user_added_by' => $id, 'contact_person' => $row['registrant_name'], 'company_name' => $row['registrant_company'],
                                        'address'     => $row['registrant_address'] . " " . $row['registrant_state'] . " " . $row['registrant_city'] . " - " . $row['registrant_zip'] . ", " . $row['registrant_country'],
                                        'email'       => $row['registrant_email'], 'phone_number_1' => $row['registrant_phone'], 'url' => $row['domain_name'],
                                        'created_at'  => $now, 'updated_at' => $now
                                    ];
                            }
                        }
                        $insertData = LocalLead::insert($data);
                    }
                }
            } else
            {
                dd("empty excel file");
            }
            
        }
        
        public function yajraFilter(Request $request)
        {
//            return json_encode($request->toArray());

//            $localLeads = LocalLead::select(['lead_id','company_name' , 'amount' , 'comment' , 'currency.*' ])->with(['note' , 'currencies'])->latest('created_at')->first();
//            dd($localLeads);
            if ($request->ajax())
            {
                $localLeads = LocalLead::with(['note', 'currencies'])->select(['local_leads.*'])->latest('created_at');
                
                return Datatables::of($localLeads)->addColumn('amount', function ($row)
                {
                    return $row->currencies->simbol . $row->amount;
                })->addColumn('note', function ($row)
                {
                    return $row->note_desc ? $row->note_desc : '-';
                })->addColumn('comment', function ($row)
                {
                    return $row->comment ? $row->comment : '-';
                })->addColumn('company_name', function ($row)
                {
                    return $row->company_name ? $row->company_name : '-';
                })->editColumn('note', function ($row)
                {
                    if ($row->note)
                    {
                        return '(' . $row->notesCount->count . ')' . $row->note->note_desc . '<a href="javascript:" class="btn btn-xs viewAllNotes" data-toggle="modal" data-target="#notes" data-lead-id="' . $row->lead_id . '"><i class="fa fa-comment"></i> </a>';
                    } else
                    {
                        return "-";
                    }
                })->filter(function ($query) use ($request)
                {
                    
                    if ($request->has('que'))
                    {
//                        dd($request->que);
                        $query->where('company_name', 'like', "%{$request->get('que')}%");
                    }
                    
                    if ($request->has('from_date') && $request->has('to_date'))
                    {
                        $from_date = new Carbon($request->get('from_date'));
                        $to_date   = new Carbon($request->get('to_date'));
                        $to_date   = $to_date->addDay()->toDateTimeString();
                        $query     = $query->whereBetween('created_at', [$from_date, $to_date]);
                        
                    }
                    
                })->make(TRUE);
                
            }
        }
        
    }
