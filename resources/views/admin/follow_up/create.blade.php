@extends('admin.layouts.app')

@section('content')
    <div>
        <div class="col-md-6 nopadding"><h3 class="page-title">Follow Up Module</h3></div>
        <div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/dashboard') }}">Dashboard</a>
                > <a href="{{ route('follow_up.index') }}">Follow Ups</a> > Create Follow Up</p></div>
    </div>

    <form id="create" method="POST" action="{{ route('follow_up.store') }}">
        <div class="new_button">
            <div class="pull-right extra_button">
                <input type="submit" id="submit" name="create_follow_up" class="btn btn-success" value="Save">
            </div>
            <div class="pull-right extra_button">
                <a href="{{ route('follow_up.index') }}" class="btn btn-danger extra_button">Back</a>
            </div>
            <div style="clear: both;"></div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                Create Follow Up Module
            </div>

            <div class="panel-body">

                {{ csrf_field() }}
                {{--<div class="row">
                    <div class="col-xs-12 col-md-12 col-sm-12 form-group">
                        <label for="status">Follow Up: </label>
                        <input type="text" name="follow_up">
                    </div>
                </div>--}}
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-sm-12 form-group">
                        <label required class="control-label">Title:* </label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                        <p class="help-block"></p>
                        {{--
                            @if($errors->has('title'))
                                <p class="help-block"> {{ $errors->first('title') }} </p>
                            @endif
                        --}}
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('javascript')
    <script>
        $('form#create').submit(function ()
        {
//            $("#submit").attr('disabled',true);
            $(this).find(':input[type=submit]').prop('disabled', true);
        });
    </script>
@endsection
