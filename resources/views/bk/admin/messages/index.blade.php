@extends('admin.layouts.app')

@section('content')

<div>
    <div class="col-md-6 nopadding"><h3 class="page-title">Messages</h3></div>
    <div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/home') }}">Dashboard</a> > Messages Pages</p></div>
</div>

<div class="new_button">
    <div class="pull-right">
        <a href="{{ route('messages.create') }}" class="btn btn-success extra_button">Add new</a>
    </div>
    <div style="clear: both;"></div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        Messages
    </div>

    <div class="col-lg-4" style="margin: 10px 10px 10px 0px">
        <form action="{{ url('/admin/messagesSearch') }}" method="POST" role="search">
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
                        <a  href="{{ route('messages.index') }}" 
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
                    <th>Identifier</th>
                    <th>Content</th>
                    <th>Actions</th>
                </tr>
            </thead>
            @if (isset($messagesList) && count($messagesList) > 0)
            <?php $i = 0; ?>
            @foreach ($messagesList as $messages)
            <tr>
                <td style="width: 10%">{{++$i}}</td>
                <td style="width: 35%">{{ $messages->identifier }}</td>
                <td style="width: 35%">{{ $messages->content }}</td>
                <td style="width: 20%">
                    <a href="{{ route('messages.edit',[$messages->id]) }}" 
                       class="btn btn-xs btn-info"> Edit </a>
                    {!! Form::open(array(
                    'style' => 'display: inline-block;',
                    'method' => 'DELETE',
                    'onsubmit' => "return confirm('".trans("Are you sure?")."');",
                    'route' => ['messages.destroy', $messages->id])) !!}
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
        {!! $messagesList->render() !!}
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


