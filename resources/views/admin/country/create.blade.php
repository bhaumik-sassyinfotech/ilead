@extends('admin.layouts.app')

@section('content')
    <div>
		<div class="col-md-6 nopadding"><h3 class="page-title">Country</h3></div>
		<div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/dashboard') }}">Dashboard</a> > <a href="{{ route('country.index') }}">Country Pages</a> > Create Country Pages</p></div>
	</div>
	
	<form method="POST" action="{{ route('country.store') }}">
	<div class="new_button">
		<div class="pull-right extra_button">
			<input type="submit" name="createCountry" class="btn btn-danger" value="Save">
		</div>
		<div class="pull-right extra_button">
			<a href="{{ route('country.index') }}" class="btn btn-success extra_button" >Back</a>
		</div>
		<div style="clear: both;"></div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            Create Country
        </div>

        <div class="panel-body">
            
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-sm-12 form-group">
                        <label class="control-label">Country Name</label>
                        <input type="text" name="country_name" class="form-control">
                        <p class="help-block"></p>
<!--                        @if($errors->has('country_name'))
                            <p class="help-block">
                                {{ $errors->first('country_name') }}
                            </p>
                        @endif-->
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-sm-12 form-group">
                        <label class="control-label">A 2</label>
                        <input type="text" name="a_2" class="form-control">
                        <p class="help-block"></p>
<!--                        @if($errors->has('a_2'))
                            <p class="help-block">
                                {{ $errors->first('a_2') }}
                            </p>
                        @endif-->
                    </div>                    
                </div>
                 <div class="row">
                    <div class="col-xs-12 col-md-12 col-sm-12 form-group">
                        <label class="control-label">A 3</label>
                        <input type="text" name="a_3" class="form-control">
                        <p class="help-block"></p>
<!--                        @if($errors->has('a_3'))
                            <p class="help-block">
                                {{ $errors->first('a_3') }}
                            </p>
                        @endif-->
                    </div>
                    
                </div>
                    
             
        </div>
    </div>
	</form>

@endsection
@section('javascript')
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=m62x62ktm38e7tw7h6e0bcv4h2xgivsxw9jpuuv0fh2mcshg"></script>   
@endsection