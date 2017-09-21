@extends('admin.layouts.app')

@section('content')
<div>
    <div class="col-md-6 nopadding"><h3 class="page-title">Faq Module</h3></div>
    <div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/dashboard') }}">Dashboard</a> > <a href="{{ route('faqmodule.index') }}">Faqmodule Pages</a> > Create Faq Module</p></div>
</div>

<form method="POST" action="{{ route('faqmodule.store') }}">
    <div class="new_button">
        <div class="pull-right extra_button">
            <input type="submit" name="createfaqmodule" class="btn btn-danger" value="Save">
        </div>
        <div class="pull-right extra_button">
            <a href="{{ route('faqmodule.index') }}" class="btn btn-success extra_button" >Back</a>
        </div>
        <div style="clear: both;"></div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            Create Faq Module
        </div>

        <div class="panel-body">

            {{ csrf_field() }}
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12 form-group">
                    <label for="status">Faq Category : </label>
                    <select class="form-control" id="cat_id" name="cat_id">
                        <option value="">--select--</option> 
                        @foreach ($faqcategoryList as $faqcategory)
                        <option value="{{$faqcategory->id}}">{{$faqcategory->title}}</option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12 form-group">
                    <label class="control-label">Title</label>
                    <input type="text" name="question" class="form-control">
                    <p class="help-block"></p>
<!--                    @if($errors->has('question'))
                    <p class="help-block">
                        {{ $errors->first('question') }}
                    </p>
                    @endif-->
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12 form-group">
                    <label class="control-label">Answer</label>
                    <input type="text" name="answer" class="form-control">
                    <p class="help-block"></p>
<!--                    @if($errors->has('answer'))
                    <p class="help-block">
                        {{ $errors->first('answer') }}
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
<script>tinymce.init({
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