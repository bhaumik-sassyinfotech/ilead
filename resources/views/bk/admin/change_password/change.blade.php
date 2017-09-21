@extends('admin.layouts.app')

@section('content')

	<div>
		<div class="col-md-6 nopadding"><h3 class="page-title">Change Password</h3></div>
		<div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/home') }}">Dashboard</a> > Change Password</p></div>
	</div>
	
	<form action="" method="post" role="form" class="form-horizontal">
	<div class="new_button">
		<div class="pull-right extra_button">
			<button type="submit" class="btn btn-danger">Save</button>
		</div>
		<div style="clear: both;"></div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Change Password</div>
        <div class="panel-body">
        @if (Session::has('success'))
            <div class="alert alert-success">{!! Session::get('success') !!}</div>
        @endif
        @if (Session::has('failure'))
            <div class="alert alert-danger">{!! Session::get('failure') !!}</div>
        @endif
        
            {{csrf_field()}}

                <div class="form-group{{ $errors->has('old') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Old Password</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="old">

                        @if ($errors->has('old'))
                            <span class="help-block">
                                <strong>{{ $errors->first('old') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Password</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

        </div>
    </div>    
	</form>
@endsection

