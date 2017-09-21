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
                    <label class="control-label">Currency lable</label>
                    <input type="text" name="lable" class="form-control">
                    <p class="help-block"></p>
<!--                    @if($errors->has('lable'))
                    <p class="help-block">
                        {{ $errors->first('lable') }}
                    </p>
                    @endif-->
                </div>
            </div>
             <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12 form-group">
                    <label class="control-label">Currency code</label>
                    <input type="text" name="code" class="form-control">
                    <p class="help-block"></p>
<!--                    @if($errors->has('code'))
                    <p class="help-block">
                        {{ $errors->first('code') }}
                    </p>
                    @endif-->
                </div>
            </div>
             <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12 form-group">
                    <label class="control-label">Currency simbole</label>
                    <input type="text" name="simbol" class="form-control">
                    <p class="help-block"></p>
<!--                    @if($errors->has('simbol'))
                    <p class="help-block">
                        {{ $errors->first('simbol') }}
                    </p>
                    @endif-->
                </div>
            </div>
             <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12 form-group">
                    <label class="control-label">Default Currency </label>
                    <input type="number" name="default_currency" class="form-control">
                    <p class="help-block"></p>
<!--                    @if($errors->has('default_currency'))
                    <p class="help-block">
                        {{ $errors->first('default_currency') }}
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