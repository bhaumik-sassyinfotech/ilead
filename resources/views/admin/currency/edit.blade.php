@extends('admin.layouts.app')

@section('content')
    <div>
        <div class="col-md-6 nopadding"><h3 class="page-title">Currency</h3></div>
        <div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/dashboard') }}">Dashboard</a>
                > <a href="{{ route('currency.index') }}">Currency Pages</a> > Edit Currency Pages</p></div>
    </div>
    {!! Form::model($currency, ['method' => 'PUT', 'route' => ['currency.update', $currency->id]]) !!}
    <div class="new_button">
        <div class="pull-right extra_button">
            <input type="submit" name="createcurrency" class="btn btn-danger" value="save">
        </div>
        <div class="pull-right extra_button">
            <a href="{{ route('currency.index') }}" class="btn btn-success extra_button">Back</a>
        </div>
        <div style="clear: both;"></div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Edit Currency
        </div>
        
        <div class="panel-body">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12 form-group">
                    <label class="control-label">Currency lable </label>
                    <input type="text" name="lable" class="form-control" value="{{$currency->lable}}">
                    <p class="help-block"></p>
                <!--                        @if($errors->has('lable'))
                    <p class="help-block">
{{ $errors->first('lable') }}
                            </p>
                        @endif-->
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12 form-group">
                    <label class="control-label">Currency code</label>
                    <input type="text" name="code" class="form-control" value="{{$currency->code}}">
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
                    <input type="text" name="simbol" class="form-control" value="{{$currency->simbol}}">
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
                    <label class="control-label" style="padding-right: 15px;">Default Currency: </label>
                    <label class="radio-inline"><input
                                {{ ( $currency->default_currency == 0 ) ? 'checked' : '' }} value="0" type="radio"
                                name="default_currency">No</label>
                    <label class="radio-inline"><input
                                {{ ( $currency->default_currency == 1 ) ? 'checked' : '' }} value="1" type="radio"
                                name="default_currency">Yes</label>
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}

@endsection
@section('javascript')
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    
    <script>
        tinymce.init({
            selector: '#textarea' ,
            height: 200 ,
            menubar: false ,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor' ,
                'searchreplace visualblocks code fullscreen' ,
                'insertdatetime media table contextmenu paste code'
            ] ,
            toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image' ,
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i' ,
                '//www.tinymce.com/css/codepen.min.css' ]
        });
    </script>

@endsection