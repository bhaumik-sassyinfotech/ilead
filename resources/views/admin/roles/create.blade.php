@extends('admin.layouts.app')

@section('content')
    <div>
        <div class="col-md-6 nopadding"><h3 class="page-title">Roles</h3></div>
        <div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/dashboard') }}">Dashboard</a>
                > <a href="{{ route('roles.index') }}">Roles and Permission</a> > Create Roles and Permission</p></div>
    </div>
    
    {!! Form::open(['method' => 'POST', 'route' => ['roles.store']]) !!}
    
    <div class="new_button">
        <div class="pull-right extra_button">
            {!! Form::submit('Save', ['class' => 'btn btn-danger']) !!}
        </div>
        <div class="pull-right extra_button">
            <a href="{{ route('roles.index') }}" class="btn btn-success extra_button">Back</a>
        </div>
        <div style="clear: both;"></div>
    </div>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            Create
        </div>
        
        <div class="panel-body role">
            
            
            <div class="col-xs-8 form-group">
                {!! Form::label('title', 'Role Title', ['class' => 'control-label']) !!}
                {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '']) !!}
                <p class="help-block"></p>
            <!--                    @if($errors->has('title'))
                <p class="help-block">
            {{ $errors->first('title') }}
                        </p>
                        @endif-->
            </div>
            
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>Actions</b>
                        <label class="checkbox-inline" style="margin-left: 10px">
                            <input type="checkbox" class="add" value="add" name="add">Add
                        </label>
                        <label class="checkbox-inline" style="margin-left: 10px">
                            <input type="checkbox" class="update" value="update" name="update">Update
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" class="view" value="view" name="view">View
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" class="delete" value="delete" name="delete">Delete
                        </label>
                    </div>
                </div>
            </div>
            
            
            <div class="col-lg-8">
                <div class="form-group">
                    <label for="status">Status : </label>
                    <select class="form-control" id="status" name="status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    {{--</div>--}}
    
    {!! Form::close() !!}
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script>
        $(document).ready(function ()
        {
            $('.faqDelete').change(function ()
            {
                if ( this.checked )
                {
                    $(".faqView").prop('checked' , false);
                    $(".faqManage").prop('checked' , false);
                }
            });
            $('.faqManage').change(function ()
            {
                if ( this.checked )
                {
                    $(".faqView").prop('checked' , false);
                    $(".faqDelete").prop('checked' , false);
                }
            });
            $('.faqView').change(function ()
            {
                if ( this.checked )
                {
                    $(".faqManage").prop('checked' , false);
                    $(".faqDelete").prop('checked' , false);
                }
            });

            $('.transDelete').change(function ()
            {
                if ( this.checked )
                {
                    $(".transView").prop('checked' , false);
                    $(".transManage").prop('checked' , false);
                }
            });
            $('.transView').change(function ()
            {
                if ( this.checked )
                {
                    $(".transManage").prop('checked' , false);
                    $(".transDelete").prop('checked' , false);
                }
            });

            $('.transManage').change(function ()
            {
                if ( this.checked )
                {
                    $(".transView").prop('checked' , false);
                    $(".transDelete").prop('checked' , false);
                }
            });
        });
    </script>
@stop