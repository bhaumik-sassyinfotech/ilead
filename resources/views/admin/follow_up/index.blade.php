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
        <div class="col-md-6 nopadding"><h3 class="page-title">Follow Up Module</h3></div>
        <div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/dashboard') }}">Dashboard</a>
                > Follow Up</p></div>
    </div>

    <div class="new_button">
        {{--@if(Helpers::getAdminPermission('faq.manage')=='true' || Helpers::getAdminPermission('faq.delete')==='true')--}}
        <div class="pull-right">
            <a href="{{ route('follow_up.create') }}" class="btn btn-success extra_button">Add new</a>
        </div>
        {{--@endif--}}
        <div style="clear: both;"></div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            Follow Up List
        </div>

        <div class="panel-body">

            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
                </thead>
                @if (isset($follow_up_list) && count($follow_up_list) > 0)
                    <?php $i=1; ?>
                    @foreach ($follow_up_list as $follow)
                        <tr>
                            <td style="width: 10%">{{ $i++ }}</td>
                            <td style="width: 25%">{{ $follow->title }}</td>

                            <td style="width: 15%">
                                <a href="{{ route('follow_up.edit',[$follow->id]) }}"
                                   class="btn btn-xs btn-info"> Edit </a>
                                {{ Form::open(array(
                                'style' => 'display: inline-block;',
                                'method' => 'DELETE',
                                'onsubmit' => "return confirm('".trans("Are you sure want to delete this faq module?")."');",
                                'route' => ['follow_up.destroy', $follow->id])) }}
                                {{ Form::submit('Delete', array('class' => 'btn btn-xs btn-danger')) }}
                                {{ Form::close() }}
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8"><p style="text-align: center;"><b>No Record Found.</b></p></td>
                    </tr>
                @endif
            </table>
            {{ $follow_up_list->render() }}
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


