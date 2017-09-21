@extends('admin.layouts.app')

@section('content')
    
	<div>
		<div class="col-md-6 nopadding"><h3 class="page-title">Sub Admins</h3></div>
		<div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/dashboard') }}">Dashboard</a> > <a href="{{ route('users.index') }}">Sub Admins </a> > Create Sub Admins</p></div>
	</div>
	
    {!! Form::open(['method' => 'POST', 'route' => ['users.store'],'enctype'=>'multipart/form-data']) !!}
	
	<div class="new_button">
		<div class="pull-right extra_button">
			{!! Form::submit('Save', ['class' => 'btn btn-danger']) !!}
		</div>
		<div class="pull-right extra_button">
			<a href="{{ route('users.index') }}" class="btn btn-success extra_button" >Back</a>
		</div>
		<div style="clear: both;"></div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
           Sub Admins Create
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-7 form-group">
                    {!! Form::label('name', 'Full Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('fullname', old('fullname'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
<!--                    @if($errors->has('fullname'))
                        <p class="help-block">
                            {{ $errors->first('fullname') }}
                        </p>
                    @endif-->
                </div>
            </div>
			<div class="row">
                <div class="col-xs-7 form-group">
                    {!! Form::label('name', 'Last Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('lastname', old('lastname'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
<!--                    @if($errors->has('lastname'))
                        <p class="help-block">
                            {{ $errors->first('lastname') }}
                        </p>
                    @endif-->
                </div>
            </div>
            <div class="row">
                <div class="col-xs-7 form-group">
                    {!! Form::label('email', 'Email*', ['class' => 'control-label']) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
<!--                    @if($errors->has('email'))
                        <p class="help-block">
                            {{ $errors->first('email') }}
                        </p>
                    @endif-->
                </div>
            </div>
            <div class="row">
                <div class="col-xs-7 form-group">
                    {!! Form::label('password', 'Password', ['class' => 'control-label']) !!}
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
<!--                    @if($errors->has('password'))
                        <p class="help-block">
                            {{ $errors->first('password') }}
                        </p>
                    @endif-->
                </div>
            </div>
            <div class="row">
                <div class="col-xs-7 form-group">
                    {!! Form::label('role_id', 'Role*', ['class' => 'control-label']) !!}
                    {!! Form::select('role_id', $roles, old('role_id'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
<!--                    @if($errors->has('role_id'))
                        <p class="help-block">
                            {{ $errors->first('role_id') }}
                        </p>
                    @endif-->
                </div>
            </div>
			<div class="row">
                <div class="col-xs-7 form-group">
                    {!! Form::label('profile_pic', 'Profile Image', ['class' => 'control-label']) !!}
                    {!! Form::file('profile_pic', old('profile_pic'), ['class' => 'form-control', 'placeholder' => ''],['id'=> 'profile_pic'] ) !!}
                    <p class="help-block"></p>
<!--                    @if($errors->has('profile_pic'))
                        <p class="help-block">
                            {{ $errors->first('profile_pic') }}
                        </p>
                    @endif-->
                </div>
            </div>
            <div class="row">
                <div class="col-xs-7 form-group">
                    <img id="profile_pic_img" height="100" width="100"/>
                </div>
            </div>
			<div class="row">
				<div class="col-xs-7 form-group">
					<label for="status">Status : </label>
					<select class="form-control" id="status" name="status">
						<option value="1">Active</option>
						<option value="0">Deactive</option> 
					</select>
				</div>
			</div>
			
        </div>
    </div>

    
    {!! Form::close() !!}
@stop

@section('javascript')
    <script>
        $('#profile_pic').change( function(event){
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('profile_pic_img');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
            
        });

        $('.date').datepicker({
            autoclose: true,
            dateFormat: "{{ config('app.date_format_js') }}"
        });
        
    </script>
    
@endsection
