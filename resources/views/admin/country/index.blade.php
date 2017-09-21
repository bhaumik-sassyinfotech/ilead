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
    <div class="col-md-6 nopadding"><h3 class="page-title">Country</h3></div>
    <div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/dashboard') }}">Dashboard</a> > Country Pages</p></div>
</div>

<div class="new_button">
    <div class="pull-right">
        <a href="{{ route('country.create') }}" class="btn btn-success extra_button">Add new</a>
    </div>
    <div style="clear: both;"></div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        Country List
    </div>
    <div class="col-lg-4" style="margin: 10px 10px 10px 0px">
        <form action="{{ url('/admin/countrySearch') }}" method="POST" role="search">
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
                        <a  href="{{ route('country.index') }}" 
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
                    <th>Country Name</th>
                    <th>A 2</th>
                    <th>A 3</th>
                    <th>Actions</th>
                </tr>
            </thead>
            @if (isset($countryList) && count($countryList) > 0)
            <?php $i = 0; ?>
            @foreach ($countryList as $country)
            <tr>
                <td style="width: 10%">{{$country->id}}</td>
                <td style="width: 25%">{{ $country->country_name }}</td>
                <td style="width: 25%">{{ $country->a_2 }}</td>
                <td style="width: 25%">{{ $country->a_3 }}</td>

                <td style="width: 15%">
                    <a href="{{ route('country.edit',[$country->id]) }}" 
                       class="btn btn-xs btn-info"> Edit </a>
                       {!! Form::open(array(
                        'style' => 'display: inline-block;',
                        'method' => 'DELETE',
                        'onsubmit' => "return confirm('".trans("Are you sure want to delete this country?")."');",
                        'route' => ['country.destroy', $country->id])) !!}
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
        {!! $countryList->render() !!}
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


