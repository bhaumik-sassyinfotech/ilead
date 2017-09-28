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
    {{ Form::open(['method' => 'PUT', 'route' => ['international.update', $leadData->lead_id] , 'name' => 'international_lead_form' , 'id' => 'international_lead_form' , 'files' => true , ]) }}
    
    <div class="panel panel-default">
        <div class="panel-heading">
            Update International Leads
        </div>
        <input type="hidden" id="lead_id" name="lead_id" value="{{ $leadData->lead_id }}">
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
                <h2>Tags</h2>
                <div class="row form-group">
                    <div class="col-md-8">
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
                <div class="col-md-12">
                    <h2>Comment</h2>
                </div>
                <div class="col-md-8">
<textarea placeholder="Enter Comment" name="lead_comment" id="lead_comment" cols="30" rows="10"
          class="form-control">{{ (isset($leadData->comment)) ? nl2br($leadData->comment) : '' }}</textarea>
                </div>
            </div>
            
            <div class="col-md-12">
                <h1>Notes</h1>
            </div>
            <div class="row">
                <div class="col-lg-7">
                    <!-- The fileinput-button span is used to style the file input field as button -->
                    <span class="btn btn-success fileinput-button dz-clickable">
                         <input type="file" name="files[]">
                        <span>Add files...</span>
                    </span>
                    <button type="submit" class="btn btn-primary start">
                        <span>Start upload</span>
                    </button>
                    <button type="reset" class="btn btn-warning cancel">
                        <span>Cancel upload</span>
                    </button>
                   
                </div>
                <br><br><br><br>
                <div class="col-md-12">
                    <br><br><br><br>
                    <div class="table table-striped" class="files" id="previews">
        
                        <div id="template" class="file-row">
                            <!-- This is used as the file preview template -->
                            <div>
                                <span class="preview"><img data-dz-thumbnail /></span>
                            </div>
                            <div>
                                <p class="name" data-dz-name></p>
                                <strong class="error text-danger" data-dz-errormessage></strong>
                            </div>
                            <div>
                                <p class="size" data-dz-size></p>
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                    <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-primary start">
                                    <i class="glyphicon glyphicon-upload"></i>
                                    <span>Start</span>
                                </button>
                                <button data-dz-remove class="btn btn-warning cancel">
                                    <i class="glyphicon glyphicon-ban-circle"></i>
                                    <span>Cancel</span>
                                </button>
                                <button data-dz-remove class="btn btn-danger delete">
                                    <i class="glyphicon glyphicon-trash"></i>
                                    <span>Delete</span>
                                </button>
                            </div>
                        </div>
    
                    </div>
                </div>
                <div class="col-md-12">
                    <div id="dz" class="dz-preview dz-file-preview">
                        <div class="dz-details">
                            <div class="dz-filename"><span data-dz-name></span></div>
                            <div class="dz-size" data-dz-size></div>
                            <img data-dz-thumbnail />
                        </div>
                        <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                        <div class="dz-success-mark"><span>✔</span></div>
                        <div class="dz-error-mark"><span>✘</span></div>
                        <div class="dz-error-message"><span data-dz-errormessage></span></div>
                    </div>
                </div>
            </div>
            <div class="row form-group" id="dynamic-div">
                <input type="button" class="btn btn-success addNote" value="Add More">
                
                <?php $count = 0; ?>
                @if(count($leadData->notes) < 1)
                    <div class="col-md-12 notesContainer">
                        <input type="hidden" id="note_id_{{ $count }}" name="note_id_{{ $count }}" value="">
                        
                        <div class="col-md-6">
<textarea placeholder="Enter notes" name="lead_note_{{ $count }}"
          id="lead_note_{{ $count }}" rows="3" class="form-control txtArea"></textarea>
                        </div>
                        <div class="col-md-3">
                            <button type="button" data-id="{{ $count }}" name="save" class="btn btn-success saveBtn">
                                Save
                            </button>
                        </div>
                        <div class="col-md-3">
                            <input class="btn btn-danger removeBtn" data-id="{{ $count }}" type="button" value="Remove">
                        </div>
                    </div>
                @else
                    <?php
                    $today = \Carbon\Carbon::now();
                    ?>
                    @foreach($leadData->notes as $note)
                        <?php $allow = FALSE; ?>
                        <div class="col-md-12 notesContainer">
                            <input type="hidden" id="note_id_{{$count}}" name="note_id_{{$count}}"
                                   value="{{ $note->note_id }}">
                            
                            <div class="col-md-6">
<textarea placeholder="Enter notes" name="lead_note_{{$count}}"
          id="lead_note_{{$count}}" rows="3"
          class="form-control txtArea">{{ $note->note_desc }}</textarea>
                            </div>
                            <?php
                            $diff = $today->diffInDays($note->created_at);
                            if ($diff == 0)
                                $allow = TRUE; ?>
                            @if($allow)
                                <div class="col-md-3">
                                    <button type="button" data-id="{{$count}}" name="save"
                                            class="btn btn-success saveBtn">
                                        Save
                                    </button>
                                </div>
                                <div class="col-md-3">
                                    <input class="btn btn-danger removeBtn" data-id="{{$count}}" type="button"
                                           value="Remove">
                                </div>
                            @endif
                        </div>
                        <?php $count++; ?>
                    @endforeach
                @endif
            
            </div>
        </div>
        
        {{ Form::submit('Save', ['class' => 'col-md-2 btn btn-success' , 'id' => 'submit']) }}
        <a class="col-md-2 btn btn-danger" href="{{ route('international.index') }}"> Back </a>
    </div>
    {{ Form::close() }}
@stop

@section('javascript')
    
    @include('admin.international_leads.js')
@stop

