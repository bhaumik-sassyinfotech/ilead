@extends('admin.layouts.app')

@section('content')

<div>
    <div class="col-md-6 nopadding"><h3 class="page-title">Faq Categorys</h3></div>
    <div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/dashboard') }}">Dashboard</a> > <a href="{{ route('faqcategorys.index') }}">Faq Categorys</a> > Edit Faq Categorys</p></div>
</div>
{!! Form::model($faqcategorys, ['method' => 'PUT', 'route' => ['faqcategorys.update', $faqcategorys->id]]) !!}
<div class="new_button">
   @if(Helpers::getAdminPermission('faq.manage')=='true' || Helpers::getAdminPermission('faq.delete')==='true')
    <div class="pull-right extra_button">
        <input type="submit" name="createFaqcategorys" class="btn btn-danger" value="save">
    </div>
@endif
    <div class="pull-right extra_button">
        <a href="{{ route('faqcategorys.index') }}" class="btn btn-success extra_button" >Back</a>
    </div>
    <div style="clear: both;"></div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        Edit Faq Categorys
    </div>

    <div class="panel-body">

        {{ csrf_field() }}
        <div class="row">
            <div class="col-xs-12 col-md-12 col-sm-12 form-group">
                <label class="control-label">Title</label>
                <input type="text" name="title" class="form-control"  value="{{$faqcategorys->title}}">
                <p class="help-block"></p>
<!--                @if($errors->has('title'))
                <p class="help-block">
                    {{ $errors->first('title') }}
                </p>
                @endif-->
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-12 col-sm-12 form-group">
                <label class="control-label">Keyword</label>
                <input type="text" name="keyword" class="form-control" value="{{$faqcategorys->keyword}}" readonly="">
                <p class="help-block"></p>
<!--                @if($errors->has('keyword'))
                <p class="help-block">
                    {{ $errors->first('keyword') }}
                </p>
                @endif-->
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-12 col-sm-12 form-group">
                <label for="status">Status : </label>
                <select class="form-control" id="status" name="status">
                    <option value="1" <?php
                    if ($faqcategorys->status == 1) {
                        echo "selected";
                    }
                    ?>>Active</option>
                    <option value="0" <?php
                    if ($faqcategorys->status == 0) {
                        echo "selected";
                    }
                    ?>>Deactive</option> 
                </select>
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