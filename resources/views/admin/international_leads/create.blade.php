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

        <div class="panel-body commom-form"> 
			<h2 class="form-title">Lead Information</h2>
			<br>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group crm-group">
						{{--<label class="crm-label">Project name</label>--}}
						{{ Form::label('project_name', 'Project Name: *', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('project_name', old('project_name'), ['class' => 'form-control crm-control', 'placeholder' => 'Enter project name', 'maxlength' => 300]) }}
						
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
                        {{ Form::label('url', 'URL: * ( http://www.example.com )', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('url', old('url') , ['class' => 'form-control crm-control', 'placeholder' => 'Enter URL']) }}
                        {{--<label class="crm-label">URL:</label>--}}
						{{--<input type="text" class="form-control crm-control">--}}
					</div>					
				</div>
			</div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{ Form::label('source', 'Source: ', ['class' => 'control-label crm-label']) }}
                        <select class="form-control crm-control" name="source" id="source">
							<option value="0">None</option>
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
                                <option value="{{ $currency->id }}">{{ $currency->code }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group crm-group">
						{{--<label class="crm-label">Amoutnt</label>--}}
                        {{ Form::label('amount', 'Amount:', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('amount', old('amount') , ['class' => 'form-control float crm-control', 'placeholder' => 'Enter amount']) }}
                        {{--<input type="text" class="form-control crm-control">--}}
					</div>					
				</div>
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{ Form::label('location', 'Location: ', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('location', old('location') , ['class' => 'form-control crm-control', 'placeholder' => 'Enter location']) }}
                        {{--<label class="crm-label">Location</label>--}}
                        {{--<input type="text" class="form-control crm-control">--}}
                    </div>
                </div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group crm-group">
                        {{ Form::label('phone_number', 'Phone Number:', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('phone_number', old('phone_number') , ['class' => 'crm-control form-control', 'placeholder' => 'Enter phone number']) }}
					</div>					
				</div>
                <div class="col-sm-6">
                    <div class="form-group crm-group">
                        {{ Form::label('phone_number_secondary', 'Secondary Phone Number:', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('phone_number_secondary', old('phone_number_secondary') , ['class' => 'crm-control form-control', 'placeholder' => 'Enter secondary phone number']) }}
                    </div>
                </div>
			</div>
			<div class="row">
				
				<div class="col-sm-6">
					<div class="form-group crm-group">
                        {{ Form::label('skype', 'Skype:', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('skype', old('skype') , ['class' => 'form-control crm-control', 'placeholder' => 'Enter skype ID']) }}
						{{--<label class="crm-label">Skype</label>--}}
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
                        {{ Form::label('email_secondary', 'Secondary Email Secondary: ', ['class' => 'control-label crm-label']) }}
                        {{ Form::text('email_secondary', old('email_secondary') , ['class' => 'form-control crm-control', 'placeholder' => 'Enter secondary email']) }}
                        {{--<label class="crm-label">Email</label>--}}
                        {{--<input type="email" class="form-control crm-control">--}}
                    </div>
                </div>
            </div>
            <br>
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
            <br>
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
                        <a class="btn btn-danger" href="{{ route('international.index') }}"> Back </a>
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
