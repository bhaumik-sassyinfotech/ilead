@extends('admin.layouts.app')

@section('content')
    <div>
        {{--<div class="col-md-6 nopadding"><h3 class="page-title">Create International Lead Module</h3></div>--}}
        <div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/dashboard') }}">Dashboard</a>
                > <a href="{{ route('international.index') }}">International Lead</a> > Create International Lead</p>
        </div>
    </div>
    {{--<h3 class="page-title">International Leads</h3>--}}
    <br>
    {{ Form::open(['method' => 'POST', 'route' => ['international.store'] , 'id' => 'international_lead_form' ,'name' => 'international_lead_form']) }}

    <div class="panel panel-default">
        <div class="panel-heading">
            Add International Leads
        </div>

        <div class="panel-body">
            <div class="row form-group">
                <div class="col-xs-6">
                    {{ Form::label('project_name', 'Project Name: *', ['class' => 'control-label']) }}
                    {{ Form::text('project_name', old('project_name'), ['class' => 'form-control', 'placeholder' => 'Enter project name', 'maxlength' => 300]) }}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-6">
                    {{ Form::label('contact_person', 'Contact Person: ', ['class' => 'control-label']) }}
                    {{ Form::text('contact_person', old('contact_person'), ['class' => 'form-control', 'placeholder' => 'Enter contact person']) }}
                    <p class="help-block"></p>
                    @if($errors->has('contact_person'))
                        <p class="help-block">
                            {{ $errors->first('contact_person') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row form-group">
                <div class="col-xs-4">
                    {{ Form::label('job_title', 'Job Title: ', ['class' => 'control-label']) }}
                    {{ Form::text('job_title', old('job_title'), ['class' => 'form-control', 'placeholder' => 'Enter job title']) }}
                    <p class="help-block"></p>
                    @if($errors->has('job_title'))
                        <p class="help-block">
                            {{ $errors->first('job_title') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-4">
                    {{ Form::label('refer_id', 'Reference ID:', ['class' => 'control-label']) }}
                    {{ Form::text('refer_id', old('refer_id') , ['class' => 'form-control', 'placeholder' => 'Enter reference ID']) }}
                </div>
                <div class="col-xs-4">
                    {{ Form::label('type', 'Type: ', ['class' => 'control-label']) }}
                    <select class="form-control" name="type" id="type">
                        <option value="">Select Type</option>
                        @foreach($follow_list as $follow )
                            <option value="{{ $follow->label }}">{{ $follow->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-xs-3">
                    {{ Form::label('currency', 'Currency: *', ['class' => 'control-label']) }}
                    {{--{{ dd($currencies) }}--}}
                    <select class="form-control" name="currency" id="currency">
                        <option value="">Select Currency</option>
                        @foreach($currencies as $currency )
                            <option value="{{ $currency->id }}">{{ $currency->lable }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-3">
                    {{ Form::label('amount', 'Amount: *', ['class' => 'control-label']) }}
                    {{ Form::text('amount', old('amount') , ['class' => 'form-control float', 'placeholder' => 'Enter amount']) }}
                </div>
                <div class="col-xs-6">
                    {{ Form::label('url', 'URL: * ( http://www.example.com )', ['class' => 'control-label']) }}
                    {{ Form::text('url', old('url') , ['class' => 'form-control', 'placeholder' => 'Enter URL']) }}
                </div>
            </div>
            <div class="row form-group">
                <div class="col-xs-3">
                    {{ Form::label('location', 'Location: ', ['class' => 'control-label']) }}
                    {{ Form::text('location', old('location') , ['class' => 'form-control', 'placeholder' => 'Enter location']) }}
                </div>
                <div class="col-xs-3">
                    {{ Form::label('email', 'Email: ', ['class' => 'control-label']) }}
                    {{ Form::text('email', old('email') , ['class' => 'form-control', 'placeholder' => 'Enter email']) }}
                </div>
                <div class="col-xs-3">
                    {{ Form::label('skype', 'Skype:', ['class' => 'control-label']) }}
                    {{ Form::text('skype', old('skype') , ['class' => 'form-control', 'placeholder' => 'Enter skype ID']) }}
                </div>
                <div class="col-xs-3">
                    {{ Form::label('phone_number', 'Phone Number:', ['class' => 'control-label']) }}
                    {{ Form::text('phone_number', old('phone_number') , ['class' => 'form-control', 'placeholder' => 'Enter phone number']) }}
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-8">
                <ul id="myTags" class="tagit ui-widget ui-widget-content ui-corner-all">
                    <li>ABC</li>
                </ul>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-12">
                    {{ Form::textarea('lead_comment',old('lead_comment') ,['size' => '115x10', 'class' => 'form-control' , 'placeholder' => 'Enter comments']) }}

                </div>
            </div>
        </div>

        {{ Form::submit('Save', ['class' => 'col-md-2 btn btn-success' , 'id' => 'submit']) }}
        <a class="col-md-2 btn btn-danger" href="{{ route('international.index') }}"> Back </a>
    {{ Form::close() }}
    </div>
@stop

@section('javascript')

    @include('admin.international_leads.js')
@stop
