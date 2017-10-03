@extends('admin.layouts.app')

@section('content')
<div>
    <div class="col-md-6 nopadding"><h3 class="page-title">Currency</h3></div>
    <div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/dashboard') }}">Dashboard</a> > <a href="{{ route('currency.index') }}">Currency</a> > Create Currency</p></div>
</div>

<form method="POST" action="{{ route('currency.store') }}">
    <div class="new_button">
        <div class="pull-right extra_button">
            <input type="submit" name="createCountry" class="btn btn-danger" value="Save">
        </div>
        <div class="pull-right extra_button">
            <a href="{{ route('currency.index') }}" class="btn btn-success extra_button" >Back</a>
        </div>
        <div style="clear: both;"></div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            Create Currency
        </div>

        <div class="panel-body">

            {{ csrf_field() }}
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12 form-group">
                    <label class="control-label">Currency label</label>
                    <input type="text" name="lable" class="form-control">
                    
                </div>
            </div>
             <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12 form-group">
                    <label class="control-label">Currency code</label>
                    <input type="text" name="code" class="form-control">

                </div>
            </div>
             <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12 form-group">
                    <label class="control-label">Currency symbol</label>
                    <input type="text" name="simbol" class="form-control">
                    
                </div>
            </div>
             <div class="row" style="display: none;">
                <div class="col-xs-12 col-md-12 col-sm-12 form-group">
                    <label class="control-label" style="padding-right: 15px;">Default Currency: </label>
                    <label class="radio-inline"><input checked value="0" type="radio" name="default_currency">No</label>
                    <label class="radio-inline"><input value="1" type="radio" name="default_currency">Yes</label>
                </div>
            </div>            
        </div>
    </div>
</form>

@endsection
@section('javascript')
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=m62x62ktm38e7tw7h6e0bcv4h2xgivsxw9jpuuv0fh2mcshg"></script>   
@endsection