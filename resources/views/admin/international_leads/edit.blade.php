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
    {{ Form::open(['method' => 'PUT', 'route' => ['international.update', $leadData->lead_id] , 'name' => 'international_lead_form' , 'id' => 'international_lead_form']) }}

    <div class="panel panel-default">
        <div class="panel-heading">
            Update International Leads
        </div>
        <input type="hidden" id="lead_id" name="lead_id" value="{{ $leadData->lead_id }}" >
        <div class="panel-body">
            <div class="row form-group">
                <div class="col-xs-6">
                    {{ Form::label('project_name', 'Project Name: *', ['class' => 'control-label']) }}
                    {{ Form::text('project_name', $leadData['project_name'], ['class' => 'form-control', 'placeholder' => 'Enter project name']) }}
                    <p class="help-block"></p>

                </div>
                <div class="col-xs-6">
                    {{ Form::label('contact_person', 'Contact Person: ', ['class' => 'control-label']) }}
                    {{ Form::text('contact_person', $leadData['contact_person'], ['class' => 'form-control', 'placeholder' => 'Enter contact person']) }}
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-xs-4">
                    {{ Form::label('job_title', 'Job Title: ', ['class' => 'control-label']) }}
                    {{ Form::text('job_title', $leadData['job_title'], ['class' => 'form-control', 'placeholder' => 'Enter job title']) }}
                    <p class="help-block"></p>

                </div>
                <div class="col-xs-4">
                    {{ Form::label('refer_id', 'Reference ID:', ['class' => 'control-label']) }}
                    {{ Form::text('refer_id', $leadData['refer_id'] , ['class' => 'form-control', 'placeholder' => 'Enter reference ID']) }}
                </div>
                <div class="col-xs-4">
                    {{ Form::label('type', 'Type: ', ['class' => 'control-label']) }}
                    <select class="form-control" name="type" id="type">
                        <option value="">Select Type</option>
                        @foreach($follow_list as $follow )
                            <?php $msg = ''; ?>
                            @if( isset($leadData->type) && ($leadData->type == $follow->label) )
                                <?php $msg = 'selected'; ?>
                            @endif
                            <option {{ $msg }} value="{{ $follow->label }}">{{ $follow->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-xs-3">
                    {{ Form::label('currency', 'Currency: *', ['class' => 'control-label']) }}
                    <select class="form-control" name="currency" id="currency">
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
                <div class="col-xs-3">
                    {{ Form::label('amount', 'Amount: *', ['class' => 'control-label']) }}
                    {{ Form::text('amount', $leadData['amount'] , ['class' => 'form-control float', 'placeholder' => 'Enter amount']) }}
                </div>
                <div class="col-xs-6">
                    {{ Form::label('url', 'URL: * ( http://www.example.com )', ['class' => 'control-label']) }}
                    {{ Form::text('url', $leadData['url'] , ['class' => 'form-control', 'placeholder' => 'Enter URL']) }}
                </div>
            </div>
            <div class="row form-group">
                <div class="col-xs-3">
                    {{ Form::label('location', 'Location: ', ['class' => 'control-label']) }}
                    {{ Form::text('location', $leadData['location'] , ['class' => 'form-control', 'placeholder' => 'Enter location']) }}
                </div>
                <div class="col-xs-3">
                    {{ Form::label('email', 'Email: ', ['class' => 'control-label']) }}
                    {{ Form::text('email', $leadData['email'] , ['class' => 'form-control', 'placeholder' => 'Enter email']) }}
                </div>
                <div class="col-xs-3">
                    {{ Form::label('skype', 'Skype:', ['class' => 'control-label']) }}
                    {{ Form::text('skype', $leadData['skype'] , ['class' => 'form-control', 'placeholder' => 'Enter skype ID']) }}
                </div>
                <div class="col-xs-3">
                    {{ Form::label('phone_number', 'Phone Number:', ['class' => 'control-label']) }}
                    {{ Form::text('phone_number', $leadData['phone_number'] , ['class' => 'form-control', 'placeholder' => 'Enter phone number']) }}
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-8">
                            <textarea placeholder="Enter Comment" name="lead_comment" id="lead_comment" cols="30" rows="10" class="form-control">
                                {{ $leadData->latestComment->lead_comment }}
                            </textarea>
                </div>
            </div>
            <div class="row form-group" id="dynamic-div">
                <input type="button" class="btn btn-success addNote" value="Add More">
                <div class="col-md-12 notesContainer">

                    <input type="hidden" name="note_id_1" value="" >

                    <div class="col-md-6">
                            <textarea placeholder="Enter notes" name="lead_notes_1" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="col-md-3">
                        <button type="button" data-id = "1" name="save" class="btn btn-success saveBtn">Save</button>
                    </div>
                    <div class="col-md-3">
                        <input class="btn btn-danger removeBtn" data-id = "1" type="button" value="Remove">
                    </div>
                </div>
            </div>
        </div>

        {{ Form::submit('Save', ['class' => 'col-md-2 btn btn-success' , 'id' => 'submit']) }}
        <a class="col-md-2 btn btn-danger" href="{{ route('international.index') }}"> Back </a>
    </div>
    {{ Form::close() }}
@stop

@section('javascript')
    <script>
        var divCount = '{{ (isset($count)) ? $count : 0 }}';
    </script>
    @include('admin.international_leads.js')
@stop

