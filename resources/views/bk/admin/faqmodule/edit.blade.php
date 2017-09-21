@extends('admin.layouts.app')

@section('content')
<div>
    <div class="col-md-6 nopadding"><h3 class="page-title">Faq Module</h3></div>
    <div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/home') }}">Dashboard</a> > <a href="{{ route('faqmodule.index') }}">Faq Module</a> > Edit Faq Module</p></div>
</div>
{!! Form::model($faqmodule, ['method' => 'PUT', 'route' => ['faqmodule.update', $faqmodule->id]]) !!}
<div class="new_button">
    @if(Helpers::getAdminPermission('faq.manage')==='true')
    <div class="pull-right extra_button">
        <input type="submit" name="createFaqmodule" class="btn btn-danger" value="save">
    </div>
    @endif
    <div class="pull-right extra_button">
        <a href="{{ route('faqmodule.index') }}" class="btn btn-success extra_button" >Back</a>
    </div>
    <div style="clear: both;"></div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        Edit Faq Module
    </div>

    <div class="panel-body">

        {{ csrf_field() }}
         <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12 form-group">
                    <label for="status">Faq Category : </label>
                    <select class="form-control" id="cat_id" name="cat_id">
                        <option value="">--select--</option> 
                        @foreach ($faqcategoryList as $faqcategory)
                        <option value="{{$faqcategory->id}}" <?php if($faqcategory->id == $faqmodule->cat_id) {?>selected<?php } ?>>{{$faqcategory->title}}</option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12 form-group">
                    <label class="control-label">Title</label>
                    <input type="text" name="question" class="form-control" value="{{$faqmodule->question}}">
                    <p class="help-block"></p>
                    @if($errors->has('question'))
                    <p class="help-block">
                        {{ $errors->first('question') }}
                    </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12 form-group">
                    <label class="control-label">Answer</label>
                    <input type="text" name="answer" class="form-control" value="{{$faqmodule->answer}}">
                    <p class="help-block"></p>
                    @if($errors->has('answer'))
                    <p class="help-block">
                        {{ $errors->first('answer') }}
                    </p>
                    @endif
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