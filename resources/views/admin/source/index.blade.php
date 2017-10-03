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
    <div class="col-md-6 nopadding"><h3 class="page-title">Source</h3></div>
    <div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/dashboard') }}">Dashboard</a> > Source</p></div>
</div>

<div class="new_button">
    <div class="pull-right">
        <a href="{{ route('source.create') }}" class="btn btn-success extra_button">Add new</a>
    </div>
    <div style="clear: both;"></div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        Source List
    </div>
    <div class="col-lg-4" style="margin: 10px 10px 10px 0px">
        <form action="{{ route('source.search') }}" method="POST" role="search">
            {{ csrf_field() }}
            <div class="input-group">
                <input type="text" class="form-control" name="q" value="{{ isset($query)? $query : '' }}">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">
                        <span class="fa fa-search"></span>
                    </button>
                </span>
                <div class="input-group" style="margin-left: 10px">
                    <span class="input-group-btn">
                        <a  href="{{ route('source.index') }}"
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
                    <th>ID</th>
                    <th>Source title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            @if (isset($sourcesData) && count($sourcesData) > 0)
            <?php $i = 0; ?>
            @foreach ($sourcesData as $src)
            <tr>
                <td style="width: 10%">{{ ++$i }}</td>
                <td style="width: 20%">{{ $src->title }}</td>
                <td style="width: 20%">
                    <a href="{{ route('source.edit',[$src->id]) }}"
                       class="btn btn-xs btn-info"> Edit </a>
                       {!! Form::open(array(
                        'style' => 'display: inline-block;',
                        'method' => 'DELETE',
                        'onsubmit' => "return confirm('".trans("Are you sure want to delete this currency?")."');",
                        'route' => ['source.destroy', $src->id])) !!}
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
        </table>
        {!! $sourcesData->render() !!}
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


