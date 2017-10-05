<?php
$default = 'inr';
$stat = 'disabled';
/*set default currency to Indian rupees.*/
?>
@extends('admin.layouts.app')
{{-- {{ dd($leadData) }}--}}
@section('content')
    <?php $count = 0; ?>
    <div>
        {{--<div class="col-md-6 nopadding"><h3 class="page-title">Create International Lead Module</h3></div>--}}
        <div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/dashboard') }}">Dashboard</a>
                > <a href="{{ route('local.index') }}">Local Lead</a> > Create Local Lead</p>
        </div>
    </div>
    {{--<h3 class="page-title">International Leads</h3>--}}
    <br>
    {{ Form::open(['method' => 'PUT', 'route' => ['local.update', $leadData->lead_id] , 'name' => 'local_lead_form' , 'id' => 'local_lead_form']) }}
    
    <div class="panel panel-default">
        <div class="panel-heading">
            Update Local Leads
        </div>
        <input type="hidden" id="lead_id" name="lead_id" value="{{ $leadData->lead_id }}">
        <div class="panel-body commom-form">
            <h2 class="form-title">Lead Information</h2>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{--<label class="crm-label">Project name</label>--}}
                        {{ Form::label('company_name', 'Company Name: ', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('company_name', $leadData['company_name'], ['class' => 'form-control crm-control', $stat , 'placeholder' => 'Enter company name', 'maxlength' => 300]) }}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{--<label class="crm-label">Contact Person</label>--}}
                        {{--<input type="text" class="form-control crm-control">--}}
                        {{ Form::label('contact_person', 'Contact Person: ', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('contact_person', $leadData['contact_person'], ['class' => 'form-control crm-control', $stat , 'placeholder' => 'Enter contact person']) }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{--<label class="crm-label">Job Title</label>--}}
                        {{--<input type="text" class="form-control crm-control">--}}
                        {{ Form::label('job_title', 'Job Title: ', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('job_title', $leadData['job_title'], ['class' => 'form-control crm-control', $stat , 'placeholder' => 'Enter job title']) }}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{--<label class="crm-label">Reference Id</label>--}}
                        {{--<input type="text" class="form-control crm-control">--}}
                        {{ Form::label('refer_id', 'Reference ID:', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('refer_id', $leadData['refer_id'] , ['class' => 'form-control crm-control', $stat , 'placeholder' => 'Enter reference ID']) }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{ Form::label('type', 'Type: ', ['class' => 'control-label crm-label']) }}
                        {{--<label class="crm-label">Type</label>--}}
                        <select {{ $stat }}  class="form-control crm-control" name="type" id="type">
                            <option value="">Select Type</option>
                            @foreach($follow_list as $follow )
                                <option value="{{ $follow->id }}">{{ $follow->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{ Form::label('url', 'URL: ( http://www.example.com )', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('url', $leadData['url'] , ['class' => 'form-control crm-control', $stat , 'placeholder' => 'Enter URL']) }}
                        {{--<label class="crm-label">URL:</label>--}}
                        {{--<input type="text" class="form-control crm-control">--}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{ Form::label('source', 'Source: *', ['class' => 'control-label crm-label']) }}
                        <select {{ $stat }}  class="form-control crm-control" name="source" id="source">
                            <option value="">Select Source</option>
                            {{--<option value="0">None</option>--}}
                            @foreach($sourceList as $src )
                                <option value="{{ $src->id }}">{{ $src->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{--<label class="crm-label">Currency</label>--}}
                        {{ Form::label('currency', 'Currency: ', ['class' => 'control-label crm-label']) }}
                        <select {{ $stat }}  class="form-control crm-control" name="currency" id="currency">
                            {{--<option value="">Select Currency</option>--}}
                            @foreach($currencies as $currency )
                                <?php $msg = ''; ?>
                                @if( $currency->id == $leadData->currency )
                                    <?php $msg = 'selected'; ?>
                                @endif
                                <option {{ $msg }} value="{{ $currency->id }}">{{ $currency->code }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{--<label class="crm-label">Amoutnt</label>--}}
                        {{ Form::label('amount', 'Amount: ', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('amount', $leadData['amount'] , ['class' => 'form-control float crm-control', $stat , 'placeholder' => 'Enter amount']) }}
                        {{--<input type="text" class="form-control crm-control">--}}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{ Form::label('status', 'Status:', ['class' => 'control-label crm-label']) }}
                        <select {{ $stat }}  class="form-control crm-control" name="status" id="status">
                            <option {{ $leadData->status == 'closed' ? 'selected' : ' ' }} value="closed">Closed</option>
                            <option {{ $leadData->status == 'open' ? 'selected' : ' ' }} value="open">Open</option>
                            <option {{ $leadData->status == 'interested' ? 'selected' : ' ' }} value="interested">Interested</option>
                            <option {{ $leadData->status == 'in_progress' ? 'selected' : ' ' }} value="in_progress">In progress</option>
                            <option {{ $leadData->status == 'converted' ? 'selected' : ' ' }} value="converted">Converted</option>
                        </select>
                        {{--<label class="crm-label">Skype</label>--}}
                        {{--<input type="text" class="form-control crm-control">--}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{ Form::label('email', 'Email: ', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('email', $leadData['email'] , ['class' => 'form-control crm-control', $stat , 'placeholder' => 'Enter email']) }}
                        {{--<label class="crm-label">Email</label>--}}
                        {{--<input type="email" class="form-control crm-control">--}}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{ Form::label('industry', 'Industry: ', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('industry', $leadData['industry'] , ['class' => 'form-control crm-control', $stat , 'placeholder' => 'Enter industry']) }}
                        {{--<label class="crm-label">Email</label>--}}
                        {{--<input type="email" class="form-control crm-control">--}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{ Form::label('phone_number_1', 'Phone Number 1:', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('phone_number_1', $leadData['phone_number_1'] , ['class' => 'crm-control form-control', $stat , 'placeholder' => 'Enter phone number']) }}
                        {{--<label class="crm-label">Phone Number</label>--}}
                        {{--<input type="tel" class="form-control crm-control">--}}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{ Form::label('phone_number_2', 'Phone Number 2:', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('phone_number_2', $leadData['phone_number_2'] , ['class' => 'crm-control form-control', $stat , 'placeholder' => 'Enter phone number']) }}
                        {{--<label class="crm-label">Phone Number</label>--}}
                        {{--<input type="tel" class="form-control crm-control">--}}
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
                        <h4 class="bold-crm-label">Address</h4>
                        {{ Form::textarea('lead_address',$leadData['address'] ,['size' => '115x10', 'class' => 'form-control text-area' , $stat , 'placeholder' => 'Enter address']) }}
                        {{--<textarea class="form-control text-area"></textarea>--}}
                    </div>
                </div>
                <div class="col-sm-6"></div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <h4 class="bold-crm-label">Comment</h4>
                        {{ Form::textarea('lead_comment',$leadData['comment'] ,['size' => '115x10', 'class' => 'form-control text-area' , $stat , 'placeholder' => 'Enter comments']) }}
                        {{--<textarea class="form-control text-area"></textarea>--}}
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
                        {{--<button class="btn btn-success">Save</button>--}}
                        {{--<button class="btn btn-danger">Back</button>--}}
                        {{ Form::submit('Save', ['class' => 'btn btn-success' , 'id' => 'submit']) }}
                        <a class="btn btn-danger" href="{{ route('local.index') }}"> Back </a>
                    </div>
                </div>
            </div>
        </div>
    
    </div>
    {{ Form::close() }}
@stop

@section('javascript')
    
    @include('admin.local_leads.js')
@stop



