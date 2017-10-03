@extends('admin.layouts.app')

@section('content')
    <div>
		<div class="col-md-6 nopadding"><h3 class="page-title">Currency</h3></div>
		<div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/dashboard') }}">Dashboard</a> > <a href="{{ route('currency.index') }}">Currency Pages</a> > Edit Currency Pages</p></div>
    </div>
	{!! Form::model($source, ['method' => 'PUT', 'id' => 'source_form' ,'route' => ['source.update', $source->id]]) !!}
	<div class="new_button">
		<div class="pull-right extra_button">
			<input type="submit" name="createcurrency" id="save" class="btn btn-success" value="Save">
		</div>
		<div class="pull-right extra_button">
			<a href="{{ route('source.index') }}" class="btn btn-danger extra_button" >Back</a>
		</div>
		<div style="clear: both;"></div>
    </div>
<div class="panel panel-default">
        <div class="panel-heading">
            Edit Source
        </div>

        <div class="panel-body">            
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-sm-12 form-group">
                        <label class="control-label">Source:* </label>
                        <input type="text" name="title" class="form-control required" value="{{$source->title}}" >
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