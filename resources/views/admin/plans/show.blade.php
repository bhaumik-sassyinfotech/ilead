@extends('admin.layouts.app')

@section('content')
    <div>
		<div class="col-md-6 nopadding"><h3 class="page-title">MemberShip Plan</h3></div>
		<div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/dashboard') }}">Dashboard</a> > <a href="{{ route('plans.index') }}">MemberShip Plan</a> > View MemberShip Plan</p></div>
	</div>
	
	<div class="new_button">
		<div class="pull-right extra_button">
			<a href="{{ route('plans.index') }}" class="btn btn-success extra_button" >Back</a>
		</div>
		<div style="clear: both;"></div>
    </div>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            View MemberShip Plan
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                    <tr>
                        <th>Name</th>
                        <td>{{ $plan->name }}</td>
                    </tr>
                    <tr>
                        <th>Plan Price (Monthly)</th>
                        <td>{{ $plan->subscription_period }}</td>
                    </tr>
                    <tr>
                        <th>Plan Price Annual</th>
                        <td>{{ $plan->subscription_perice }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ $plan->status }}</td>
                    </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>
            
        </div>
    </div>
@stop