@extends('admin.layouts.app')

@section('content')
<div>
    <div class="col-md-6 nopadding"><h3 class="page-title">CMS Pages</h3></div>
    <div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/home') }}">Dashboard</a> > <a href="{{ route('cms.index') }}">CMS Pages</a> > Edit CMS Pages</p></div>
</div>
{!! Form::model($cms, ['method' => 'PUT', 'route' => ['cms.update', $cms->id]]) !!}
<div class="new_button">
    <div class="pull-right extra_button">
        <input type="submit" name="createCms" class="btn btn-danger" value="save">
    </div>
    <div class="pull-right extra_button">
        <a href="{{ route('cms.index') }}" class="btn btn-success extra_button" >Back</a>
    </div>
    <div style="clear: both;"></div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        Edit CMS Pages
    </div>

    <div class="panel-body">
        <!-- <form method="POST" action="{{ route('cms.store') }}"> -->

        {{ csrf_field() }}
        <div class="row">
            <div class="col-xs-6 col-md-6 col-sm-6 form-group">
                <label class="control-label">Website Title</label>
                <input type="text" name="website_title" class="form-control" value="{{$cms->website_title}}">
                <p class="help-block"></p>
                @if($errors->has('website_title'))
                <p class="help-block">
                    {{ $errors->first('website_title') }}
                </p>
                @endif
            </div>
            <div class="col-xs-6 col-md-6 col-sm-6 form-group">
                <label class="control-label">Keyword</label>
                <input type="text" name="keyword" id="keyword" class="form-control" value="{{$cms->keyword}}" readonly="">
                <p class="help-block"></p>
                @if($errors->has('keyword'))
                <p class="help-block">
                    {{ $errors->first('keyword') }}
                </p>
                @endif
            </div>

        </div>
        <div class="row">
            <div class="col-xs-12 form-group">
                <label for="status">Description : </label>
                <textarea id="summernote" name="summernote">
						{!! $cms->description !!}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-md-6 col-sm-6 form-group">
                <label for="status">Meta Title : </label>
                <input name="meta_title" class="form-control" value="{!! $cms->meta_title !!}"/>
            </div>

            <div class="col-xs-6 col-md-6 col-sm-6 form-group">
                <label for="status">Status : </label>
                <select class="form-control" id="status" name="status">
                    <option value="1" <?php
                    if ($cms->status == 1) {
                        echo "selected";
                    }
                    ?>>Active</option>
                    <option value="0" <?php
                    if ($cms->status == 0) {
                        echo "selected";
                    }
                    ?>>Deactive</option> 
                </select>
            </div>
        </div>


        <div class="row">
            <div class="col-xs-6 form-group">
                <label for="status">Meta Keyword : </label>
                <textarea name="meta_keyword" class="form-control" >{!! $cms->meta_keyword !!}</textarea>
            </div>
            <div class="col-xs-6 form-group">
                <label for="status">Meta Description : </label>
                <textarea name="meta_description" class="form-control" >{!! $cms->meta_description !!}</textarea>
            </div>
        </div>


        <div class="row">

        </div> 
    </div>
</div>
</form>

@endsection
@section('javascript')
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>

<script>
tinymce.init({
    selector: '#summernote',
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