@extends('admin.layouts.app')

@section('content')
    <div>
		<div class="col-md-6 nopadding"><h3 class="page-title">Sub Admins</h3></div>
		<div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/dashboard') }}">Dashboard</a> > <a href="{{ route('users.index') }}">Sub Admins </a> > Edit Sub Admins</p></div>
	</div>
	
    
    {!! Form::model($user, ['method' => 'PUT', 'route' => ['users.update', $user->id],'enctype'=>'multipart/form-data']) !!}
	
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
            Sub Admins Edit
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('name', 'First Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('fullname', old('fullname'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
<!--                    @if($errors->has('fullname'))
                        <p class="help-block">
                            {{ $errors->first('fullname') }}
                        </p>
                    @endif-->
                </div>
                <div class="col-xs-6 form-group">
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
                
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('email', 'Email*', ['class' => 'control-label']) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => '','readonly']) !!}
                    <p class="help-block"></p>
<!--                    @if($errors->has('email'))
                        <p class="help-block">
                            {{ $errors->first('email') }}
                        </p>
                    @endif-->
                </div>
                <div class="col-xs-6 form-group">
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
                     <?php                     
                     if($user->profile_pic != null) { ?>
                     <img id="profile_pic_img" src="<?php echo url('/').'/public/uploads/profile_pic/'.$user->profile_pic; ?>" height="100" width="100"/>
                        <?php } else { ?>
                     <img id="profile_pic_img" src="<?php echo url('/').'/public/uploads/no-user-image.png';?>" height="100" width="100"/>
                        <?php } ?>
                   
                </div>
            </div>
            <?php
            $module = json_decode($user->module);
            $checked = 'checked';
            ?>
            <div class="row">
                <div class="col-md-6">
                    <label class="checkbox-inline" style="margin-left: 10px">
                        <input {{ $module->international == 'TRUE' ? $checked : ' ' }} type="checkbox" value="international" name="international">International Lead
                    </label>
                    <label class="checkbox-inline" style="margin-left: 10px">
                        <input {{ $module->local == 'TRUE' ? $checked : ' ' }} type="checkbox" value="local" name="local">Local Lead
                    </label>
                    <label class="checkbox-inline">
                        <input {{ $module->cold == 'TRUE' ? $checked : ' ' }} type="checkbox" value="cold" name="cold">Cold Calling
                    </label>
                </div>
            </div>
			<div class="row" style="display: none">
				<div class="col-xs-6 form-group">
					<label for="status">Status : </label>
					<select  class="form-control" id="status" name="status" >
						<option value="1" <?php if($user->status == 1) { echo "selected"; }?> >Active</option>
						<option value="0" <?php if($user->status == 0) { echo "selected"; }?>>Deactive</option> 
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

