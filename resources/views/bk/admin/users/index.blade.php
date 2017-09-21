@inject('request', 'Illuminate\Http\Request')
@extends('admin.layouts.app')

@section('content')
@if(session()->has('success'))       
<div class="alert alert-success">
{{ session()->get('success') }}   
</div>
@endif
@if(session()->has('err_msg'))  
<div class="alert alert-success">
{{ session()->get('err_msg') }}  
</div>
@endif

<div>
    <div class="col-md-6 nopadding"><h3 class="page-title">Sub Admin</h3></div>
    <div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/home') }}">Dashboard</a> > Sub Admin</p></div>
</div>


<div class="new_button">
    <div class="pull-right">
        <a href="{{ route('users.create') }}" class="btn btn-success extra_button">Add new</a>
    </div>
    <div style="clear: both;"></div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        Sub Admin List
    </div>
    <div class="col-lg-4" style="margin: 10px 10px 10px 10px">
        <form action="{{ url('/admin/userSearch') }}" method="POST" role="search">
            {{ csrf_field() }}
            <div class="row">
                <div class="input-group">
                    <input type="text" class="form-control" name="q"
                           placeholder="{{ isset($placeholder_string)? $placeholder_string : '' }}" value="{{ isset($q)? $q : '' }}"> <span class="input-group-btn">
                        <button type="submit" class="btn btn-default">
                            <span class="fa fa-search"></span>
                        </button>
                    </span>
                    <div class="input-group" style="margin-left: 10px">
                        <span class="input-group-btn">
                            <a  href="{{ route('users.index') }}" 
                                class="input-group-btn btn btn-default">
                                <span class="fa fa-refresh"></span>
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </form>
    </div> 

    <div class="panel-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($users) && count($users) > 0)
                <?php $i = 0; ?>
                @foreach ($users as $user)
                <tr>                               
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->fullname }} {{ $user->lastname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->title or '' }}</td>
                    <td>
                        @if($user->status > 0)  Active 
                        @else Deactive
                        @endif
                    </td> 
                    <td>
                        <a href="{{ route('users.edit',[$user->id]) }}" class="btn btn-xs btn-info">Edit</a>
                        {!! Form::open(array(
                        'style' => 'display: inline-block;',
                        'method' => 'DELETE',
                        'onsubmit' => "return confirm('".trans("Are you sure want to delete this sub admin?")."');",
                        'route' => ['users.destroy', $user->id])) !!}
                        {!! Form::submit('Delete', array('class' => 'btn btn-xs btn-danger')) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="8"><p style="text-align: center;"><b>No Record Found.</b></p></td>
                </tr>
                @endif
            </tbody>
        </table>
        @if(isset($users)) {!! $users->render() !!} @endif
    </div>
</div>
@stop