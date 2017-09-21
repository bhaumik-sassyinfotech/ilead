@extends('admin.layouts.app')

@section('content')
    <div>
		<div class="col-md-6 nopadding"><h3 class="page-title">Store Language</h3></div>
		<div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/dashboard') }}">Dashboard</a> > <a href="{{ route('storeLanguage.index') }}">Block Pages</a> > Create Store Language Pages</p></div>
	</div>
	
	<form method="POST" action="{{ route('storeLanguage.store') }}">
	<div class="new_button">
		<div class="pull-right extra_button">
			<input type="submit" name="createstoreLanguage" class="btn btn-danger" value="Save">
		</div>
		<div class="pull-right extra_button">
			<a href="{{ route('storeLanguage.index') }}" class="btn btn-success extra_button" >Back</a>
		</div>
		<div style="clear: both;"></div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            Create Store Language
        </div>

        <div class="panel-body">
            
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-sm-12 form-group">
                        <label class="control-label">Language name</label>
                        <input type="text" name="lang_name" id="lang_name" class="form-control">
                        <p class="help-block"></p>
<!--                        @if($errors->has('lang_name'))
                            <p class="help-block">
                                {{ $errors->first('lang_name') }}
                            </p>
                        @endif-->
                    </div>
                    
                </div>
                    
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <label for="status">ISO 631 1 code : </label>
                        <input type="text" name="iso_631_1_code" id="iso_631_1_code" class="form-control">
                        <p class="help-block"></p>
<!--                        @if($errors->has('iso_631_1_code'))
                            <p class="help-block">
                                {{ $errors->first('iso_631_1_code') }}
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