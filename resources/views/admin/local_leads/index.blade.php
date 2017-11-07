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
        <div class="col-md-6 nopadding"><h3 class="page-title">Local Leads</h3></div>
        <div class="col-md-6 pull-right nopadding"><p style="float:right;">
                <a href="{{ url('/admin/dashboard') }}">Dashboard</a> > Local Leads</p>
        </div>
    </div>
    <div class="new_button">
        <div class="pull-right">
            <a href="{{ route('local.create') }}" class="btn btn-success extra_button">Add new</a>
        </div>
        <div style="clear: both;"></div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading"> Local Leads List</div>
        <div class="col-lg-12" style="margin: 10px 10px 10px 0px">
            <form action="{{ route('local.searchLead') }}" method="POST"
                  role="search">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-3"><input value="{{ isset($start) ? date("d-m-Y" , strtotime($start)):'' }}"
                                                 name="start" placeholder="Select start date" type="text"
                                                 class="form-control start"></div>
                    <div class="col-md-3"><input value="{{ isset($end) ? date("d-m-Y" , strtotime($end)):'' }}"
                                                 name="end" type="text" placeholder="Select end date"
                                                 class="form-control end">
                    </div>
                    <div class="col-md-4 input-group">
                        <input type="text" class="form-control" name="q" placeholder="Enter search term here"
                               value="{{ isset($query) ? $query : '' }}">
                        <span class="input-group-btn"> <button type="submit" class="btn btn-default"> <span
                                        class="fa fa-search">
                                </span>
                            </button>
                        </span>
                        <div class="input-group" style="margin-left: 10px">
                            <span class="input-group-btn">
                                <a href="{{ route('international.index') }}" class="input-group-btn btn btn-default">
                                    <span class="fa fa-refresh"></span>
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped" id="local-leads">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Company Name</th>
                    <th>Amount (INR)</th>
                    <th>Comment</th>
                    <th>Notes</th>
                    <th>Actions</th>
                </tr>
                </thead> 
				@if (isset($localLeads) && count($localLeads) >0)                                        <?php $i = 0; ?>                    
				@foreach ($localLeads as $lead)
                    <tr>
                        <td style="width: 10%">{{ ++$i }}</td>
                        <td style="width: 20%">{{ !isset($lead->company_name) ? "-": $lead->company_name }}</td>
                        <td style="width: 10%">
                            @if(empty($lead->currencies))
                                {{  "-"  }}
                            @else
                                {{ $lead->currencies->simbol ."".number_format($lead->amount , 2) }}
                            @endif
                        </td>
                        <td style="width: 20%">
                            {{ is_null($lead->comment) ? '-' : $lead->comment }}
                        </td>
                        <td>
                            {{ is_null($lead->note) ? '-' : $lead->note->note_desc }}
                        </td>
                        <td style="width: 20%"><a href="{{ route('local.edit',[$lead->lead_id]) }}"
                                                  class="btn btn-xs btn-info"> Edit </a>
                            {{ Form::open(array( 'style' => 'display: inline-block;', 'method' => 'DELETE', 'onsubmit' => "return confirm('".trans("Are you sure want to delete this lead?")."');" , 'route' => ['local.destroy', $lead->lead_id])) }}
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
            </table> {{ $localLeads->render() }}
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            $.fn.datepicker.defaults.orientation = "bottom";
            $.fn.datepicker.defaults.format = '{{ Config::get('constant.DATEPICKER_FORMAT') }}';
            var d = new Date();
            $('.start').datepicker({
                endDate: d
            }).on('change', function () {
                $('.end').val('');
            });
            $('.end').datepicker();
        });
		
		
		$('#local-leads').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('local.searchLead') }}',
        columns: [
            {data: 0, name: 'id'},
            {data: 1, name: 'company_name'},
            {data: 2, name: 'amount'},
            {data: 3, name: 'created_at'},
            {data: 4, name: 'updated_at'}
        ]
    });
    </script>
@endsection