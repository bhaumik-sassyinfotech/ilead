@extends('admin.layouts.app')

@section('content')
<div>
    <div class="col-md-6 nopadding"><h3 class="page-title">Source</h3></div>
    <div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/dashboard') }}">Dashboard</a> > <a href="{{ route('source.index') }}">Source</a> > Create Source</p></div>
</div>

<form id="source_form" method="POST" action="{{ route('source.store') }}">
    <div class="new_button">
        <div class="pull-right extra_button">
            <input type="submit" name="createCountry" id="save" class="btn btn-danger" value="Save">
        </div>
        <div class="pull-right extra_button">
            <a href="{{ route('source.index') }}" class="btn btn-success extra_button" >Back</a>
        </div>
        <div style="clear: both;"></div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            Create Source
        </div>

        <div class="panel-body">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12 form-group">
                    <label class="control-label">Source:*</label>
                    <input type="text" name="title" id="title" class="form-control required">
                    <p class="help-block"></p>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection
@section('javascript')
    <script type="text/javascript">
        $("#source_form").validate({
            rules:
            {
                title: 'required',
            },
            submitHandler: function( form )
            {
                $("#save").attr('disabled',true);
                form.submit();
            }
        });
    </script>
@endsection