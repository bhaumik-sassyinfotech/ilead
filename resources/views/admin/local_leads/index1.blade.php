@extends('admin.layouts.app')

@section('content')
<link href="https://datatables.yajrabox.com/css/datatables.bootstrap.css" rel="stylesheet">
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
        <form id="search_form" action="#" method="POST"
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
                    <a href="{{ route('local.index') }}" class="input-group-btn btn btn-default">
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
                <th>Note</th>
                <?php /*<th>Notes</th>
                <th>Actions</th>
                 */ ?>
            </tr>
        </thead>
    </table>
    {{ $localLeads->render() }}
</div>
</div>
@endsection

@section('javascript')

{{--<script src="http://datatables.yajrabox.com/js/jquery.min.js"> </script>--}}

{{--<script src="http://datatables.yajrabox.com/js/bootstrap.min.js"> </script>--}}

{{--<script src="http://datatables.yajrabox.com/js/jquery.dataTables.min.js"></script>--}}

{{--<script src="http://datatables.yajrabox.com/js/datatables.bootstrap.js"></script>--}}

<script type="text/javascript">


    $(document).ready(function ()
    {

        $.fn.datepicker.defaults.orientation = "bottom";
        $.fn.datepicker.defaults.format = '{{ Config::get('constant.DATEPICKER_FORMAT') }}';
        var d = new Date();
        $('.start').datepicker({
            endDate: d
        }).on('change', function () {
            console.log(new Date($('.start').val()));
            $('.end').empty().datepicker({
                startDate: new Date($('.start').val())
            });

        });


        var oTable = $('#local-leads').DataTable({

            processing: true,

            searching: false,

            serverSide: true,

            ajax:
            {
                url: '{{ route('local.yajra') }}',
                type: "POST",
                data: function (d)
                {
                    d._token = $("input[name=_token]").val();
                    d.que = $('input[name="q"]').val();

                    d.from_date = $('.start').val();

                    d.to_date = $('.end').val();

                }
            },
            columns:
            [
                {data: 'lead_id'},
                {data: 'company_name'},
                {data: 'amount'},
                {data: 'comment'},
                {data: 'note'},
                // {data: 'note'},
            ]
        });

        $("#search_form").on('submit' , function (event) {
            oTable.draw();
            event.preventDefault();
        });

    });




</script>
@endsection