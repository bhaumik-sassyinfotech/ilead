@extends('admin.layouts.app')

@section('content')
@if(session()->has('success'))       
<div class="alert alert-success">
    {{ session()->get('success') }}   
</div>
@endif
@if(session()->has('err_msg'))  
<div class="alert alert-danger">
    {{ session()->get('err_msg') }}  
</div>
@endif
<div>
    <div class="col-md-6 nopadding"><h3 class="page-title">Roles</h3></div>
    <div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/dashboard') }}">Dashboard</a> > Roles and Permission</p></div>
</div>




<div class="new_button">
<!--    <div class="pull-right">
        <a href="#" class="btn btn-danger delete_all extra_button" id="deleteData">Delete selected</a>
    </div>-->
    <div class="pull-right">
        <a href="{{ route('roles.create') }}" class="btn btn-success extra_button" >Add new</a>
    </div>
    <div style="clear: both;"></div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        Roles List
    </div>
    <div class="col-lg-4" style="margin: 10px 10px 10px 0px">
        <form action="{{ url('/admin/searchRoles') }}" method="POST" role="search">
            {{ csrf_field() }}
            <div class="input-group">
                <input type="text" class="form-control" name="q"
                       placeholder="{{ isset($placeholder_string)? $placeholder_string : '' }}" value="{{ isset($q)? $q : '' }}"> 
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">
                        <span class="fa fa-search"></span>
                    </button>
                </span>
                <div class="input-group" style="margin-left: 10px">
                    <span class="input-group-btn">
                        <a  href="{{ route('roles.index') }}" 
                            class="input-group-btn btn btn-default">
                            <span class="fa fa-refresh"></span>
                        </a>
                    </span>
                </div>
            </div>
        </form>
    </div> 

    <div class="panel-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
<!--                        <th style="text-align:center;">
                        <input type="checkbox"  id="master"  value="all" />
                    </th>-->
                    <th>#Id</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @if (isset($roles) && count($roles) > 0)
                @foreach ($roles as $role)

                <tr data-entry-id="{{ $role->id }}">
<!--                                <td style="text-align:center;"><input  type="checkbox" name="checkbox[]" data-id="{{$role->id}}" class="sub_chk" /> </td>-->
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->title }}</td>
                    <td>
                        @if($role->status > 0)  Active 
                        @else Deactive
                        @endif
                    </td> 
                    <td>
                        <!--<a href="{{ route('roles.show',[$role->id]) }}" class="btn btn-xs btn-primary">View</a>-->

                        <a href="{{ route('roles.edit',[$role->id]) }}" class="btn btn-xs btn-info">Edit</a>

                        {!! Form::open(array(
                        'style' => 'display: inline-block;',
                        'method' => 'DELETE',
                        'onsubmit' => "return confirm('".trans("Are you sure want to delete this role?")."');",
                        'route' => ['roles.destroy', $role->id])) !!}
                        {!! Form::submit('Delete', array(
                        'class' => 'btn btn-xs btn-danger')) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="5"><p style="text-align: center;"><b>No Record Found.</b></p></td>
                </tr>
                @endif
            </tbody>
        </table>
        <div class="col-lg-6"></div>
        <div class="col-lg-6">
            @if(isset($roles)) {!! $roles->render() !!} @endif
        </div>
    </div>
</div>
@stop

@section('javascript')
<script type="text/javascript">
    $(document).ready(function () {

    $('#master').on('click', function(e) {
    if ($(this).is(':checked', true))
    {
    $(".sub_chk").prop('checked', true);
    } else {
    $(".sub_chk").prop('checked', false);
    }
    });
    });
    $('.delete_all').on('click', function(e) {

    var allVals = [];
    $(".sub_chk:checked").each(function() {
    allVals.push($(this).attr('data-id'));
    });
    if (allVals.length <= 0)
    {
    alert("Please select row.");
    } else {

    var check = confirm("Are you sure you want to delete this row?");
    if (check == true){

    var join_selected_values = allVals.join(",");
    console.log('{!! route('roles.mass_destroy') !!}');
    debugger;
    $.ajax({
    url: '{!! route('roles.mass_destroy') !!}',
            type: 'DELETE',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: 'ids=' + join_selected_values,
            success: function (data) {
            if (data['success']) {
            $(".sub_chk:checked").each(function() {
            $(this).parents("tr").remove();
            });
            console.log('success');
            } else if (data['error']) {
            console.log('error');
            } else {
            alert('Whoops Something went wrong!!');
            }
            },
            error: function (data) {
            alert(data.responseText);
            }
    });
    $.each(allVals, function(index, value) {
    $('table tr').filter("[data-row-id='" + value + "']").remove();
    });
    }
    }
    });
</script>
@endsection