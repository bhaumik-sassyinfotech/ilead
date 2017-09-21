@extends('admin.layouts.app')

@section('content')

<div>
    <div class="col-md-6 nopadding"><h3 class="page-title">Faq Module</h3></div>
    <div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/home') }}">Dashboard</a> > Faq Module</p></div>
</div>

<div class="new_button">
    @if(Helpers::getAdminPermission('faq.manage')=='true')
    <div class="pull-right">
        <a href="{{ route('faqmodule.create') }}" class="btn btn-success extra_button">Add new</a>
    </div>
    @endif
    <div style="clear: both;"></div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        Faq Module List 
    </div>

    <div class="col-lg-4" style="margin: 10px 10px 10px 0px">
        <form action="{{ url('/admin/faqmoduleSearch') }}" method="POST" role="search">
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
                        <a  href="{{ route('faqmodule.index') }}" 
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
                    <th>Title</th>
                    <th>Keyword</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            @if (isset($faqmoduleList) && count($faqmoduleList) > 0)
            <?php $i = 0; ?>
            @foreach ($faqmoduleList as $faqmodule)
            <tr>
                <td style="width: 10%">{{++$i}}</td>
                <td style="width: 25%">{{ $faqmodule->cat_id }}</td>
                <td style="width: 25%">{{ $faqmodule->question }}</td>
                <td style="width: 25%">{{ $faqmodule->answer }}</td>


                <td style="width: 15%">
                    @if(Helpers::getAdminPermission('faq.manage')==='false' && Helpers::getAdminPermission('faq.view')==='true')
                    <a href="{{ route('faqmodule.edit',[$faqmodule->id]) }}" 
                       class="btn btn-xs btn-info"> View </a>
                    @else             
                    <a href="{{ route('faqmodule.edit',[$faqmodule->id]) }}" 
                       class="btn btn-xs btn-info"> Edit </a>
                    {!! Form::open(array(
                    'style' => 'display: inline-block;',
                    'method' => 'DELETE',
                    'onsubmit' => "return confirm('".trans("Are you sure?")."');",
                    'route' => ['faqmodule.destroy', $faqmodule->id])) !!}
                    {!! Form::submit('Delete', array('class' => 'btn btn-xs btn-danger')) !!}
                    {!! Form::close() !!}
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
        {!! $faqmoduleList->render() !!}
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


