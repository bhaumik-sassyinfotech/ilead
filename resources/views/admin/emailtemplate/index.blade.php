@extends('admin.layouts.app')

@section('content')   
@if(session()->has('success'))       
<div class="alert alert-success">
    {{ session()->get('success') }}   
</div>
@endif
@if(session()->has('err_msg'))  
<div class="alert alert-danger">
    {{ session()->get('err_msg') }}  
</div>
@endif
<section class="content">

<div>
	<div class="col-md-6 nopadding"><h3 class="page-title">Email Templates</h3></div>
	<div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/dashboard') }}">Dashboard</a> > Email Templates</p></div>
</div>

<div class="new_button">
	<div class="pull-right">
		<a href="{{ route('emailtemplate.create') }}" class="btn btn-success extra_button">Add new</a>
	</div>
	<div style="clear: both;"></div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                   Email Templates List
                </h4>
                <div class="pull-right">
               
                </div>
                
            </div>
			  <div class="panel-heading clearfix">
                  @if (Session::has('success'))
                    <div class="alert alert-success">{!! Session::get('success') !!}</div>
                @endif
                @if (Session::has('failure'))
                    <div class="alert alert-danger">{!! Session::get('failure') !!}</div>
                @endif
            </div>
			<div class="col-lg-4" style="margin: 10px 10px 10px 0px">
				<form action="{{ url('/admin/searchEmailtemplate') }}" method="POST" role="search">
					{{ csrf_field() }}
					<div class="input-group">
						<input type="text" class="form-control" name="q"
							placeholder="{{ isset($placeholder_string)? $placeholder_string : '' }}" value="{{ isset($q)? $q : '' }}"> 
							<span class="input-group-btn">
								<button type="submit" class="btn btn-default">
									<span class="fa fa-search"></span>
								</button>
							</span>
						<div class="input-group" style="margin-left: 10px">
							<span class="input-group-btn">
								<a  href="{{ route('emailtemplate.index') }}" 
									class="input-group-btn btn btn-default">
									<span class="fa fa-refresh"></span>
								</a>
							</span>
						</div>
					</div>
				</form>
			</div>
			
            <br />
            <div class="panel-body">
              
				<table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Title</th>
                            <th>Subject</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                 @if (isset($emailtemplates) && count($emailtemplates) > 0)
                        @foreach ($emailtemplates as $bemailtemplate)
                            <tr>
                                <td style="width: 10%">{{ $bemailtemplate->id }}</td>
                                <td style="width: 30%">{{{ $bemailtemplate->title }}}</td>
                                <td style="width: 50%">{{{ $bemailtemplate->subject }}}</td>
                                <td style="width: 10%">
                                    <a href="{{{ URL::to('/admin/emailtemplate/' . $bemailtemplate->id . '/edit' ) }}}" class="btn btn-xs btn-info">Edit</a>
                                </td>
                            </tr>
						
                        @endforeach
                       @else
                            <tr>
                                <td colspan="8"><p style="text-align: center;"><b>No Record Found.</b></p></td>
                            </tr>
                @endif
                    </tbody>
                </table>
				<div class="col-lg-6"></div>
				<div class="col-lg-6">
						@if(isset($emailtemplates)) {!! $emailtemplates->render() !!} @endif
				</div>
            </div>
        </div>
    </div>
</div>    <!-- row-->
</section>

@endsection