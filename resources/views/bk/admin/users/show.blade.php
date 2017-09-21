@extends('admin.layouts.app')

@section('content')
    <div>
		<div class="col-md-6 nopadding"><h3 class="page-title">Sub Admins</h3></div>
		<div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/home') }}">Dashboard</a> > <a href="{{ route('users.index') }}">Sub Admins </a> > View Sub Admins</p></div>
	</div>
	
	
	<div class="new_button">
		<div class="pull-right extra_button">
			<a href="{{ route('users.index') }}" class="btn btn-success extra_button" >Back</a>
		</div>
		<div style="clear: both;"></div>
    </div>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            View
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr><th>Name</th>
                    <td>{{ $user->name }}</td></tr><tr><th>Email</th>
                    <td>{{ $user->email }}</td></tr><tr><th>Password</th>
                    <td>---</td></tr><tr><th>Role</th>
                    <td>{{ $user->role->title or '' }}</td></tr><tr><th>Remember token</th>
                    <td>{{ $user->remember_token }}</td></tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            
        </div>
    </div>
@stop