@extends('admin.layouts.app')

@section('content')
    <div>
		<div class="col-md-6 nopadding"><h3 class="page-title">Messages</h3></div>
		<div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/dashboard') }}">Dashboard</a> > <a href="{{ route('messages.index') }}">Messages Pages</a> > Edit Messages Pages</p></div>
    </div>
	{!! Form::model($messages, ['method' => 'PUT', 'route' => ['messages.update', $messages->id]]) !!}
	<div class="new_button">
		<div class="pull-right extra_button">
			<input type="submit" name="createMessages" class="btn btn-danger" value="save">
		</div>
		<div class="pull-right extra_button">
			<a href="{{ route('messages.index') }}" class="btn btn-success extra_button" >Back</a>
		</div>
		<div style="clear: both;"></div>
    </div>
<div class="panel panel-default">
        <div class="panel-heading">
            Edit Messages
        </div>

        <div class="panel-body">
            
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-sm-12 form-group">
                        <label class="control-label">Identifier</label>
                        <input type="text" name="identifier" class="form-control" value="{{$messages->identifier}}" readonly=""> 
                        <p class="help-block"></p>
<!--                        @if($errors->has('identifier'))
                            <p class="help-block">
                                {{ $errors->first('identifier') }}
                            </p>
                        @endif-->
                    </div>
                    
                </div>
                    
                <div class="row">
                    <div class="col-xs-12 form-group">
                        <label for="status">Content : </label>
                        <textarea id="content" name="content"  class="form-control">{{$messages->content}}</textarea>
                    </div>
                </div>
        </div>
    </div>
</form>

@endsection
@section('javascript')
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>

    <script>
    tinymce.init({
        selector: '#textarea',
        height: 200,
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code'
        ],
        toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css']
    });
    </script>

@endsection