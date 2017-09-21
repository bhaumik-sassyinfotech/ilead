@extends('admin.layouts.app')

@section('content')   
<!-- <meta name="csrf-token" content="{{ csrf_token() }}" /> -->

<div>
    <div class="col-md-6 nopadding"><h3 class="page-title">Email Templates</h3></div>
    <div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/dashboard') }}">Dashboard</a> > <a href="{{ route('emailtemplate.index') }}">Email Templates</a> > Edit Email Templates</p></div>
    <div class="clearfix"></div>
</div>

<!-- /.box-header -->
<!--<div class="col-md-8">-->
<!-- form start -->

{{ Form::open(['route'=>['emailtemplate.update',$emailtemplate->id], 'method'=>'put'])}}

<div class="new_button">
    <div class="pull-right extra_button">
        {!! Form::submit('Save', ['class' => 'btn btn-danger']) !!}
    </div>
    <div class="pull-right extra_button">
        <a href="{{ route('emailtemplate.index') }}" class="btn btn-success extra_button" >Back</a>
    </div>
    <div style="clear: both;"></div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        Update Email Templates
    </div>

    {!! csrf_field() !!}
    <div class="panel-body">
        <div class="box-body">

            <div class="form-group col-sm-6">
                <label for="title" class="control-label">Title</label>

                <input type="text" class="form-control" id="title" name="title" placeholder="" value="{{$emailtemplate->title  or old('title') }}">
                <span class="help-block">{{ $errors->first('title', ':message') }}</span>
            </div>
            <div class="form-group col-sm-6">
                <label for="keyword" class="control-label">Slug name</label>

                <input type="text" class="form-control" id="keyword" name="keyword" placeholder="" value="{{$emailtemplate->keyword  or old('keyword') }}" readonly="">
                <span class="help-block">{{ $errors->first('keyword', ':message') }}</span>
            </div>


            <div class="form-group col-sm-12">
                <label for="paypal_acc" class="control-label">subject</label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="" value="{{$emailtemplate->subject  or  old('subject') }}">
                <span class="help-block">{{ $errors->first('subject', ':message') }}</span>
            </div>

            <div class="form-group col-sm-12 ck-editor">
                <label for="paypal_acc" class="control-label">Content</label>
                <div class="input-group">
                    <div class="box-body pad">
                        <form>
                            <textarea id="editor1" name="content" rows="10" cols="80">
						{{$emailtemplate->content	  or  old('content') }}
                            </textarea>
                        </form>
                    </div>
                </div>
            </div>
          <div class="form-group col-sm-12 ">
                <div class="macros">
                    <label for="content" class="control-label">Macros</label>
                    <input type="hidden" class="form-control" id="macros" name="macros" placeholder="" value="{{$emailtemplate->macros  or old('macros') }}" readonly="">
                    <label class="control-label">{{$emailtemplate->macros}}</label>
                </div>
            </div>        
        </div>
    </div>

    <!-- /.box-body -->
</div>
{!! Form::close() !!}


<!--</div>-->
@endsection

@section('javascript')
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=m62x62ktm38e7tw7h6e0bcv4h2xgivsxw9jpuuv0fh2mcshg"></script>
<script>tinymce.init({
    selector: 'textarea',
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