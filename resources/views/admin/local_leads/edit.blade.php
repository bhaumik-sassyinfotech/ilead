@extends('admin.layouts.app')
{{-- {{ dd($leadData) }}--}}
@section('content')
    <?php $count = 0; ?>
    <div>
        {{--<div class="col-md-6 nopadding"><h3 class="page-title">Create International Lead Module</h3></div>--}}
        <div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/dashboard') }}">Dashboard</a>
                > <a href="{{ route('international.index') }}">International Lead</a> > Create International Lead</p>
        </div>
    </div>
    {{--<h3 class="page-title">International Leads</h3>--}}
    <br>
    {{ Form::open(['method' => 'PUT', 'route' => ['international.update', $leadData->lead_id] , 'name' => 'international_lead_form' , 'id' => 'international_lead_form' , 'files' => TRUE , 'enctype' => 'multipart/form-data']) }}
    
    <div class="panel panel-default">
        <div class="panel-heading">
            Update International Leads
        </div>
        <input type="hidden" id="lead_id" name="lead_id" value="{{ $leadData->lead_id }}">
        <div class="panel-body commom-form">
            <h2 class="form-title">Lead Information</h2>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{ Form::label('project_name', 'Project Name: *', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('project_name', $leadData['project_name'], ['class' => 'form-control crm-control', 'placeholder' => 'Enter project name']) }}
                        {{--<label class="crm-label">Project name</label>--}}
                        {{--<input type="text" class="form-control crm-control"> --}}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{ Form::label('contact_person', 'Contact Person: ', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('contact_person', $leadData['contact_person'], ['class' => 'form-control crm-control', 'placeholder' => 'Enter contact person']) }}
                        {{--<label class="crm-label">Contact Person</label>--}}
                        {{--<input type="text" class="form-control crm-control">--}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{ Form::label('job_title', 'Job Title: ', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('job_title', $leadData['job_title'], ['class' => 'form-control crm-control', 'placeholder' => 'Enter job title']) }}
                        {{--<label class="crm-label">Job Title</label>--}}
                        {{--<input type="text" class="form-control crm-control"> --}}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{ Form::label('refer_id', 'Reference ID:', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('refer_id', $leadData['refer_id'] , ['class' => 'form-control crm-control', 'placeholder' => 'Enter reference ID']) }}
                        {{--<label class="crm-label">Reference Id</label>--}}
                        {{--<input type="text" class="form-control crm-control">--}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{ Form::label('type', 'Type: ', ['class' => 'control-label crm-label']) }}
                        {{--<label class="crm-label">Type</label>--}}
                        <select class="form-control crm-control" name="type" id="type">
                            <option value="">Select Type</option>
                            @foreach($follow_list as $follow )
                                <?php $msg = ''; ?>
                                @if( isset($leadData->type) && ($leadData->type == $follow->id) )
                                    <?php $msg = 'selected'; ?>
                                @endif
                                <option {{ $msg }} value="{{ $follow->id }}"> {{ $follow->title }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{--<label class="crm-label">URL:</label>--}}
                        {{--<input type="text" class="form-control crm-control">--}}
                        {{ Form::label('url', 'URL: * ( http://www.example.com )', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('url', $leadData['url'] , ['class' => 'form-control crm-control', 'placeholder' => 'Enter URL']) }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{ Form::label('source', 'Source: *', ['class' => 'control-label crm-label']) }}
                        <select class="form-control crm-control" name="source" id="source">
                            <option value="">Select Source</option>
                            @foreach($sourceList as $src )
                                <?php $msg=''; ?>
                                @if($leadData['source_id'] == $src->id)
                                    <?php $msg='selected'; ?>
                                @endif
                                <option {{ $msg }} value="{{ $src->id }}">{{ $src->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{--<label class="crm-label">Currency</label>--}}
                        {{ Form::label('currency', 'Currency: *', ['class' => 'control-label crm-label']) }}
                        <select class="form-control crm-control" name="currency" id="currency">
                            <option value="">Select Currency</option>
                            @foreach($currencies as $currency )
                                <?php $msg = ''; ?>
                                @if( $currency->id == $leadData->currency )
                                    <?php $msg = 'selected'; ?>
                                @endif
                                <option {{ $msg }} value="{{ $currency->id }}">{{ $currency->lable }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{--<label class="crm-label">Amoutnt</label>--}}
                        {{--<input type="text" class="form-control crm-control">--}}
                        {{ Form::label('amount', 'Amount: *', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('amount', $leadData['amount'] , ['class' => 'form-control float crm-control', 'placeholder' => 'Enter amount']) }}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{--<label class="crm-label">Location</label>--}}
                        {{--<input type="text" class="form-control crm-control">--}}
                        {{ Form::label('location', 'Location: ', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('location', $leadData['location'] , ['class' => 'form-control crm-control', 'placeholder' => 'Enter location']) }}
                    </div>
                </div>
            </div>
            <div class="row">
                
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{--<label class="crm-label">Phone Number</label>--}}
                        {{--<input type="tel" class="form-control crm-control">--}}
                        {{ Form::label('phone_number', 'Phone Number:', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('phone_number', $leadData['phone_number'] , ['class' => 'form-control crm-control', 'placeholder' => 'Enter phone number']) }}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{--<label class="crm-label">Email</label>--}}
                        {{--<input type="email" class="form-control crm-control">--}}
                        {{ Form::label('email', 'Email: ', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('email', $leadData['email'] , ['class' => 'form-control crm-control', 'placeholder' => 'Enter email']) }}
                    </div>
                </div>
            </div>
            <div class="row">
                
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{--<label class="crm-label">Skype</label>--}}
                        {{--<input type="text" class="form-control crm-control">--}}
                        {{ Form::label('skype', 'Skype:', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('skype', $leadData['skype'] , ['class' => 'form-control crm-control', 'placeholder' => 'Enter skype ID']) }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <h4 class="bold-crm-label">Tags</h4>
                        <ul id="myTags" class="tagit ui-widget ui-widget-content ui-corner-all">
                            <?php $tags = explode("," , $leadData->tags); ?>
                            @if(count($tags) > 0)
                                @foreach($tags as $tag)
                                    <li>{{ $tag }}</li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                
                </div>
                <div class="col-sm-6"></div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <h4 class="bold-crm-label">Comment</h4>
                        <textarea placeholder="Enter Comment" name="lead_comment" id="lead_comment" cols="30" rows="10"
                                  class="form-control txtArea">{{ (isset($leadData->comment)) ? nl2br($leadData->comment) : '' }}</textarea>
                    </div>
                </div>
                <div class="col-sm-6"></div>
            </div>
            <div class="row form-group" id="dynamic-div">
                <div class="col-sm-12"><h4 class="bold-crm-label">Notes</h4></div>
                
                <?php $count = 0; ?>
                
                @if(count($leadData->notes) < 1)
                    <div id="notes_{{ $count }}" class="col-sm-12 notesContainer">
                        <div class="note-bg">
                            <input type="hidden" id="note_id_{{ $count }}" name="note_id_{{ $count }}" value="">
                            <textarea data-id="{{ $count }}" placeholder="Enter notes" name="lead_note_{{ $count }}"
                                      id="lead_note_{{ $count }}"
                                      rows="3" class="form-control notes-area txtArea"></textarea>
                            <div class="btn-col">
                                <button type="button" name="save" data-id="{{ $count }}"
                                        class="btn btn-success saveBtn">Save
                                </button>
                                <button class="btn btn-danger removeBtn" data-id="{{ $count }}" type="button">Remove
                                </button>
                            </div>
                        </div>
                    </div>
                @else
                    <?php
                    
                    $today = \Carbon\Carbon::now();
                    ?>
                    @foreach($leadData->notes as $note)
                        <?php $allow = FALSE;
                            $diff = $today->diffInDays($note->created_at);
                            $status = 'disabled';
                            if ($diff == 0)
                            {
                                $status = '';
                                $allow = TRUE;
                            }
                            ?>
                        <div id="notes_{{ $count }}" class="col-md-12 notesContainer">
                            <div class="note-bg">
                                <input type="hidden" id="note_id_{{$count}}" name="note_id_{{$count}}"
                                       value="{{ $note->note_id }}">
                                <textarea {{ $status }} data-id="{{ $count }}" placeholder="Enter notes" name="lead_note_{{$count}}"
                                          id="lead_note_{{$count}}" rows="3"
                                          class="form-control notes-area txtArea">{{ nl2br($note->note_desc) }}</textarea>

                                @if($allow)
                                    <div class="btn-col">
                                        <button type="button" data-id="{{$count}}" name="save"
                                                class="btn btn-success saveBtn"> Save
                                        </button>
                                        <input class="btn btn-danger removeBtn" data-id="{{$count}}" type="button"
                                               value="Remove">
                                    </div>
                                @endif
                            </div>
                        </div>
                        <?php $count++; ?>
                    @endforeach
                @endif
                <div class="col-md-12">
                    <input type="button" class="btn btn-success addNote valid" value="Add Note"
                           aria-invalid="false"><br>
                </div>
            </div>
            
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <button class="btn btn-success">Save</button>
                        <a class="btn btn-danger" href="{{ route('international.index') }}"> Back </a>
                        {{--<button class="btn btn-danger">Back</button>--}}
                    </div>
                </div>
            </div>
        </div>
    
    
    </div>
    {{ Form::close() }}
@stop

@section('javascript')
    
    @include('admin.international_leads.js')
@stop


