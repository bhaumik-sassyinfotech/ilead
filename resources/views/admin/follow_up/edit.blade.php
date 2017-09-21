@extends('admin.layouts.app')

@section('content')
    <div>
        <div class="col-md-6 nopadding"><h3 class="page-title">Follow up Module</h3></div>
        <div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/dashboard') }}">Dashboard</a>
                > <a href="{{ route('follow_up.index') }}">Follow Ups</a> > Create Follow Up</p></div>
    </div>
    {!! Form::model($follow, ['method' => 'PUT', 'route' => ['follow_up.update', $follow->id]]) !!}
    <div class="new_button">
        <div class="pull-right extra_button">
            <input type="submit" name="create_follow_up" class="btn btn-success" value="save">
        </div>
        <div class="pull-right extra_button">
            <a href="{{ route('follow_up.index') }}" class="btn btn-danger extra_button">Back</a>
        </div>
        <div style="clear: both;"></div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Edit Follow Up Module
        </div>

        <div class="panel-body">

            {{ csrf_field() }}
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12 form-group">
                    <label class="control-label">Title:*</label>
                    <input type="text" name="title" class="form-control" value="{{$follow->title}}">
                    <p class="help-block"></p>
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}

@endsection