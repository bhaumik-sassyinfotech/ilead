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
    <div class="col-md-6 nopadding"><h3 class="page-title">CMS Pages</h3></div>
    <div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/dashboard') }}">Dashboard</a> > CMS Pages</p></div>
</div>

<div class="new_button">
    <div class="pull-right">
        <a href="{{ route('cms.create') }}" class="btn btn-success extra_button">Add new</a>
    </div>
    <div style="clear: both;"></div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        CMS Pages List
    </div>

    <div class="col-lg-4" style="margin: 10px 10px 10px 0px">
        <form action="{{ url('/admin/cmsSearch') }}" method="POST" role="search">
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
                        <a  href="{{ route('cms.index') }}" 
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
                    <th>#ID</th>
                    <th>Website Title</th>
                    <th>Keyword</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            @if (isset($cmsList) && count($cmsList) > 0)
            <?php $i = 0; ?>
            @foreach ($cmsList as $cms)
            <tr>
                <td style="width: 10%">{{$cms->id}}</td>
                <td style="width: 50%">{{ $cms->website_title }}</td>
                <td style="width: 20%">{{ $cms->keyword }}</td>
                <td style="width: 10%">
                    @if($cms->status > 0)  <span  class="status status_active">Active </span>
                    @else
                    <span class="status status_deactive">Deactive </span>
                    
                    @endif
                </td>
                <td style="width: 10%">
                    <a href="{{ route('cms.edit',[$cms->id]) }}" 
                       class="btn btn-xs btn-info"> Edit </a>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="8"><p style="text-align: center;"><b>No Record Found.</b></p></td>
            </tr>
            @endif
        </table>
        {!! $cmsList->render() !!}
    </div>
</div>
@endsection
@section('javascript')
<script>
    $(document).ready(function () {
        $('#bootstrap-table').bdt({
            showSearchForm: 0,
            showEntriesPerPageField: 0
        });
    });
</script>
@endsection


