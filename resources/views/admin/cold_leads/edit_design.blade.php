@extends('admin.layouts.app')

@section('content')
<?php $count=0; ?>
    <div>
        {{--<div class="col-md-6 nopadding"><h3 class="page-title">Create International Lead Module</h3></div>--}}
        <div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/dashboard') }}">Dashboard</a>
                > <a href="{{ route('international.index') }}">International Lead</a> > Create International Lead</p>
        </div>
    </div>
    {{--<h3 class="page-title">International Leads</h3>--}}
    <br>
    {{ Form::open(['method' => 'PUT', 'route' => ['international.update', $leadData->lead_id] , 'name' => 'international_lead_form' , 'id' => 'international_lead_form' , 'files' => true , 'enctype' => 'multipart/form-data']) }}
    
    <div class="panel panel-default">
        <div class="panel-heading">
            Update International Leads
        </div>
        <div class="panel-body commom-form">
            <h2 class="form-title">Lead Information</h2>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group crm-group">
						<label class="crm-label">Project name</label>
						<input type="text" class="form-control crm-control"> 
					</div>					
				</div>
				<div class="col-sm-6">
					<div class="form-group crm-group">
						<label class="crm-label">Contact Person</label>
						<input type="text" class="form-control crm-control">
					</div>					
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group crm-group">
						<label class="crm-label">Job Title</label>
						<input type="text" class="form-control crm-control"> 
					</div>					
				</div>
				<div class="col-sm-6">
					<div class="form-group crm-group">
						<label class="crm-label">Reference Id</label>
						<input type="text" class="form-control crm-control">
					</div>					
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group crm-group">
						<label class="crm-label">Type</label>
						<select class="form-control crm-control">
							<option>Select type</option>
							<option>Select type</option>
							<option>Select type</option>
							<option>Select type</option>
							<option>Select type</option>
						</select>
					</div>					
				</div>
				<div class="col-sm-6">
					<div class="form-group crm-group">
						<label class="crm-label">URL:</label>
						<input type="text" class="form-control crm-control">
					</div>					
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group crm-group">
						<label class="crm-label">Currency</label>
						<select class="form-control crm-control">
							<option>Select Currency</option>
							<option>Select type</option>
							<option>Select type</option>
							<option>Select type</option>
							<option>Select type</option>
						</select>
					</div>					
				</div>
				<div class="col-sm-6">
					<div class="form-group crm-group">
						<label class="crm-label">Amoutnt</label>
						<input type="text" class="form-control crm-control">
					</div>					
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group crm-group">
						<label class="crm-label">Location</label>
						<input type="text" class="form-control crm-control">
					</div>					
				</div>
				<div class="col-sm-6">
					<div class="form-group crm-group">
						<label class="crm-label">Phone Number</label>
						<input type="tel" class="form-control crm-control">
					</div>					
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group crm-group">
						<label class="crm-label">Email</label>
						<input type="email" class="form-control crm-control">
					</div>					
				</div>
				<div class="col-sm-6">
					<div class="form-group crm-group">
						<label class="crm-label">Skype</label>
						<input type="text" class="form-control crm-control">
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
						<h4 class="bold-crm-label">Comment</h4>
						<textarea class="form-control text-area"></textarea>
					</div>					
				</div>
				<div class="col-sm-6"></div>
			</div>
			<div class="row form-group" id="dynamic-div">
				<div class="col-sm-12"><h4 class="bold-crm-label">Notes</h4></div>
				<input type="button" class="btn btn-success addNote valid" value="Add More" aria-invalid="false"><br>
				
				<div class="col-sm-12 notesContainer">
					<textarea placeholder="Enter notes" name="lead_note_{{ $count }}" id="lead_note_{{ $count }}" rows="3" class="form-control notes-area"></textarea>
					<button type="button" name="save" data-id="1" class="btn btn-success saveBtn">Save</button>
					<button class="btn btn-danger removeBtn" data-id="{{ $count }}" type="button">Remove</button>
				</div>
			</div>
			
			
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group">
						<button class="btn btn-success">Save</button>
						<button class="btn btn-danger">Back</button>
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

