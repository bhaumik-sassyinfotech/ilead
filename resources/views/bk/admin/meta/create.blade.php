@extends('admin.layouts.app')

@section('content')
<div>
	<div class="col-md-6 nopadding"><h3 class="page-title">Meta Pages</h3></div>
	<div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/home') }}">Dashboard</a> > <a href="{{ route('meta.index') }}">CMS Pages</a> > Create CMS Pages</p></div>
</div>

<form method="POST" action="{{ route('meta.store') }}">
<div class="new_button">
	<div class="pull-right extra_button">
		<input type="submit" name="createMeta" class="btn btn-danger" value="Save">
	</div>
	<div class="pull-right extra_button">
		<a href="{{ route('meta.index') }}" class="btn btn-success extra_button" >Back</a>
	</div>
	<div style="clear: both;"></div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        Create Meta Pages
    </div>

    <div class="panel-body">
        
            {{ csrf_field() }}
            
           <div class="row">
                <div class="col-xs-12 form-group">
                    <label class="control-label">Website Title</label>     
                       <input type="text" name="website_title" class="form-control">
                </div>
                 
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    <label class="control-label">Page Url</label>
                    <input type="text" name="page_url" class="form-control">
                </div>
                 <div class="col-xs-6 form-group">
                    <label class="control-label">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control">
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 form-group">
                    <label class="control-label">Meta Keyword</label>                   
                    <textarea name="meta_keyword" class="form-control"></textarea>
                </div>
                 <div class="col-xs-6 form-group">
                            <label for="status">Meta Description : </label>
                            <textarea name="meta_description" class="form-control"></textarea>
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
    height: 500,
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