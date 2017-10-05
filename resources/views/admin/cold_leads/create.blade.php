<?php
/*set default currency to australian dollar.*/
    $defaultCurrency = 'aud';
?>
@extends('admin.layouts.app')

@section('content')
    <div>
        {{--<div class="col-md-6 nopadding"><h3 class="page-title">Create International Lead Module</h3></div>--}}
        <div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/dashboard') }}">Dashboard</a>
                > <a href="{{ route('cold.index') }}">Cold Lead</a> > Create Cold Lead</p>
        </div>
    </div>
    {{--<h3 class="page-title">International Leads</h3>--}}
    <br>
    {{ Form::open(['method' => 'POST', 'route' => ['cold.store'] , 'id' => 'cold_lead_form' ,'name' => 'cold_lead_form']) }}
    
    <div class="panel panel-default">
        <div class="panel-heading">
            Add Cold Leads
        </div>
        
        <div class="panel-body commom-form">
            <h2 class="form-title">Cold Information</h2>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{--<label class="crm-label">Project name</label>--}}
                        {{ Form::label('company_name', 'Company Name: ', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('company_name', old('company_name'), ['class' => 'form-control crm-control', 'placeholder' => 'Enter company name', 'maxlength' => 300]) }}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{--<label class="crm-label">Contact Person</label>--}}
                        {{--<input type="text" class="form-control crm-control">--}}
                        {{ Form::label('contact_person', 'Contact Person: ', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('contact_person', old('contact_person'), ['class' => 'form-control crm-control', 'placeholder' => 'Enter contact person']) }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{--<label class="crm-label">Job Title</label>--}}
                        {{--<input type="text" class="form-control crm-control">--}}
                        {{ Form::label('job_title', 'Job Title: ', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('job_title', old('job_title'), ['class' => 'form-control crm-control', 'placeholder' => 'Enter job title']) }}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{--<label class="crm-label">Reference Id</label>--}}
                        {{--<input type="text" class="form-control crm-control">--}}
                        {{ Form::label('refer_id', 'Reference ID:', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('refer_id', old('refer_id') , ['class' => 'form-control crm-control', 'placeholder' => 'Enter reference ID']) }}
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
                                <option value="{{ $follow->id }}">{{ $follow->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{ Form::label('url', 'URL: ( http://www.example.com )', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('url', old('url') , ['class' => 'form-control crm-control', 'placeholder' => 'Enter URL']) }}
                        {{--<label class="crm-label">URL:</label>--}}
                        {{--<input type="text" class="form-control crm-control">--}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{ Form::label('source', 'Source: *', ['class' => 'control-label crm-label']) }}
                        <select class="form-control crm-control" name="source" id="source">
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
                        <select class="form-control crm-control" name="currency" id="currency">
                            <option value="">Select Currency</option>
                            @foreach($currencies as $currency )
                                <?php $msg = ''; ?>
                                @if( strtolower($defaultCurrency)  == strtolower($currency->code) )
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
                        {{ Form::text('amount', old('amount') , ['class' => 'form-control float crm-control', 'placeholder' => 'Enter amount']) }}
                        {{--<input type="text" class="form-control crm-control">--}}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{ Form::label('status', 'Status:', ['class' => 'control-label crm-label']) }}
                        <select class="form-control crm-control" name="status" id="status">
                            <option value="closed">Closed</option>
                            <option value="open">Open</option>
                            <option value="interested">Interested</option>
                            <option value="in_progress">In progress</option>
                            <option value="converted">Converted</option>
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
                        {{ Form::text('email', old('email') , ['class' => 'form-control crm-control', 'placeholder' => 'Enter email']) }}
                        {{--<label class="crm-label">Email</label>--}}
                        {{--<input type="email" class="form-control crm-control">--}}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{ Form::label('industry', 'Industry: ', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('industry', old('industry') , ['class' => 'form-control crm-control', 'placeholder' => 'Enter industry']) }}
                        {{--<label class="crm-label">Email</label>--}}
                        {{--<input type="email" class="form-control crm-control">--}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{ Form::label('phone_number_1', 'Phone Number 1:', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('phone_number_1', old('phone_number_1') , ['class' => 'crm-control form-control', 'placeholder' => 'Enter phone number']) }}
                        {{--<label class="crm-label">Phone Number</label>--}}
                        {{--<input type="tel" class="form-control crm-control">--}}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{ Form::label('phone_number_2', 'Phone Number 2:', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('phone_number_2', old('phone_number_2') , ['class' => 'crm-control form-control', 'placeholder' => 'Enter phone number']) }}
                        {{--<label class="crm-label">Phone Number</label>--}}
                        {{--<input type="tel" class="form-control crm-control">--}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{ Form::label('staff_size', 'Staff Size: ', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('staff_size', old('staff_size') , ['class' => 'crm-control form-control', 'placeholder' => 'Enter staff size']) }}
                        {{--<label class="crm-label">Phone Number</label>--}}
                        {{--<input type="tel" class="form-control crm-control">--}}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{ Form::label('distance', 'Distance :', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('distance', old('distance') , ['class' => 'crm-control form-control', 'placeholder' => 'Enter distance']) }}
                        {{--<label class="crm-label">Phone Number</label>--}}
                        {{--<input type="tel" class="form-control crm-control">--}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{ Form::label('postcode', 'Postcode:', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('postcode', old('postcode') , ['class' => 'crm-control form-control', 'placeholder' => 'Enter postcode']) }}
                        {{--<label class="crm-label">Phone Number</label>--}}
                        {{--<input type="tel" class="form-control crm-control">--}}
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{ Form::label('state', 'State:', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('state', old('state') , ['class' => 'crm-control form-control', 'placeholder' => 'Enter state']) }}
                        {{--<label class="crm-label">Phone Number</label>--}}
                        {{--<input type="tel" class="form-control crm-control">--}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    {{ Form::label('type_1', 'Type:', ['class' => 'control-label crm-label']) }}
                    <select name="type_1" id="type_1" class="form-control crm-control">
                        <option value="1">Phone</option>
                        <option value="2">External</option>
                    </select>
                </div>
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{ Form::label('linked_in', 'Linked In:', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('linked_in', old('linked_in') , ['class' => 'crm-control form-control', 'placeholder' => 'Enter Linked In']) }}
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
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6"></div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <h4 class="control-label bold-crm-label">Address 1</h4>
                        {{ Form::textarea('lead_address_1',old('lead_address_1') ,['size' => '115x10', 'class' => 'form-control text-area' , 'placeholder' => 'Enter address']) }}
                        {{--<textarea class="form-control text-area"></textarea>--}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <h4 class="control-label bold-crm-label">Address 2</h4>
                        {{ Form::textarea('lead_address_2',old('lead_address_2') ,['size' => '115x10', 'class' => 'form-control text-area' , 'placeholder' => 'Enter address']) }}
                        {{--<textarea class="form-control text-area"></textarea>--}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <h4 class="bold-crm-label">Comment</h4>
                        {{ Form::textarea('lead_comment',old('lead_comment') ,['size' => '115x10', 'class' => 'form-control text-area' , 'placeholder' => 'Enter comments']) }}
                        {{--<textarea class="form-control text-area"></textarea>--}}
                    </div>
                </div>
                <div class="col-sm-6"></div>
            </div>
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        {{--<button class="btn btn-success">Save</button>--}}
                        {{--<button class="btn btn-danger">Back</button>--}}
                        {{ Form::submit('Save', ['class' => 'btn btn-success' , 'id' => 'submit']) }}
                        <a class="btn btn-danger" href="{{ route('cold.index') }}"> Back </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
@stop

@section('javascript')
    @include('admin.cold_leads.js')
@stop
