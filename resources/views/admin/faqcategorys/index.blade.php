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
    <div class="col-md-6 nopadding"><h3 class="page-title">Faq Categorys</h3></div>
    <div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/dashboard') }}">Dashboard</a> > Faq Categorys</p></div>
</div>

<div class="new_button">
    @if(Helpers::getAdminPermission('faq.manage')=='true' || Helpers::getAdminPermission('faq.delete')==='true')
    <div class="pull-right">
        <a href="{{ route('faqcategorys.create') }}" class="btn btn-success extra_button">Add new</a>
    </div>
    @endif
    <div style="clear: both;"></div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        Faq Categorys List 
    </div>

    <div class="col-lg-4" style="margin: 10px 10px 10px 0px">
        <form action="{{ url('/admin/faqcategorysSearch') }}" method="POST" role="search">
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
                        <a  href="{{ route('faqcategorys.index') }}" 
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
                    <th>Title</th>
                    <th>Keyword</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            @if (isset($faqcategorysList) && count($faqcategorysList) > 0)
            <?php $i = 0; ?>
            @foreach ($faqcategorysList as $faqcategorys)
            <tr>
                <td style="width: 10%">{{$faqcategorys->id}}</td>
                <td style="width: 25%">{{ $faqcategorys->title }}</td>
                <td style="width: 25%">{{ $faqcategorys->keyword }}</td>
                <td style="width: 25%">
                @if($faqcategorys->status == 1)
                <span  class="status status_active">Active </span>
                @else
                <span class="status status_deactive">Deactive </span>
                @endif
                
                </td>

                <td style="width: 15%">
                    @if(Helpers::getAdminPermission('faq.manage')==='false' && Helpers::getAdminPermission('faq.view')==='true')
                        <a href="{{ route('faqcategorys.edit',[$faqcategorys->id]) }}" class="btn btn-xs btn-info">View</a>
                        @else
                        <a href="{{ route('faqcategorys.edit',[$faqcategorys->id]) }}" class="btn btn-xs btn-info">Edit</a>
                         @if(Helpers::getAdminPermission('faq.delete')==='true') 
                      {!! Form::open(array(
                        'style' => 'display: inline-block;',
                        'method' => 'DELETE',
                        'onsubmit' => "return confirm('".trans("Are you sure want to delete this faq category?")."');",
                        'route' => ['faqcategorys.destroy', $faqcategorys->id])) !!}
                        {!! Form::submit('Delete', array('class' => 'btn btn-xs btn-danger')) !!}
                        {!! Form::close() !!}
                        @endif
                        @endif
                   
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="8"><p style="text-align: center;"><b>No Record Found.</b></p></td>
            </tr>
            @endif
        </table>
        {!! $faqcategorysList->render() !!}
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


