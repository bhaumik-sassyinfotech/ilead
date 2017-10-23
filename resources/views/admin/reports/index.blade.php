{{--{{ dd($leads) }}--}}
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
        <div class="col-md-6 nopadding"><h3 class="page-title">International Leadss</h3></div>
        <div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/dashboard') }}">Dashboard</a>
                > Reports</p></div>
    </div>
    <?php
    $perm = json_decode(Helpers::getCurrentUserDetails('permissions' , 'false' , 'true'));
    ?>
    
    <div class="new_button">
        <div class="pull-right">
            @if($perm->add == 'TRUE')
                <a href="{{ route('international.create') }}" class="btn btn-success extra_button">Add new</a>
            @else
                <a href="#" style="visibility: hidden;" class="btn">&nbsp;</a>
            @endif
        </div>
        <div style="clear: both;"></div>
    </div>
    
    
    <div class="panel panel-default">
        <div class="panel-heading">
            International Leads List
        </div>
        <div class="col-lg-12" style="margin: 10px 10px 10px 0px">
            {{--<br><br><br><br><br>--}}
            <form action="{{ route('report.listing',Request::segment(4)) }}" method="POST" role="search">
                {{ csrf_field() }}
                
                <div class="row">
                    <div class="col-md-2">
                        <input value="{{ !empty($startDate) ? date("d-m-Y" , strtotime($startDate)):'' }}" name="start"
                               placeholder="Start date" type="text" class="form-control start">
                    </div>
                    <div class="col-md-2">
                        <input value="{{ !empty($endDate) ? date("d-m-Y" , strtotime($endDate)):'' }}" name="end" type="text"
                               placeholder="End date" class="form-control end">
                    </div>
                    <div class="col-md-2">
                        <label for="only_my_leads">
                            <input {{ $onlyMyLead ? 'checked' : '' }} type="checkbox" name="only_my_leads" id="only_my_leads" value="1">
                            Show only my leads
                        </label>
                    </div>
                    <div class="col-md-4 input-group">
                        <input type="text" placeholder="Enter search text " class="form-control" name="searchQuery" value="{{ !empty($searchQuery)? $searchQuery : '' }}">
                        
                        <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">
                        <span class="fa fa-search"></span>
                    </button>
                </span>
                        <div class="input-group" style="margin-left: 10px">
                    <span class="input-group-btn">
                        <a href="{{ route('report.listing',[Request::segment(4)]) }}"
                           class="input-group-btn btn btn-default">
                            <span class="fa fa-refresh"></span>
                        </a>
                    </span>
                        </div>
                    </div>
                </div>
                <br>
            
            </form>
        </div>
        
        <div class="panel-body">
            
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Role</th>
                    <th>Name</th>
                    <th>Project Name</th>
                    <th>Amount</th>
                    <th>Comment</th>
                    <th>Notes</th>
                </tr>
                </thead>
                @if (isset($leads) && count($leads) > 0)
                    <?php  $i = 0; ?>
                    
                    @foreach ($leads as $lead)
                        <tr>
                            <td style="width: 5%">{{ ++$i }}</td>
                            <td style="width: 5%">
                                @if($lead->userDetails->role_id == Config::get('constant.MANAGER_ID') )
                                    {{ "Manager" }}
                                @elseif($lead->userDetails->role_id == Config::get('constant.EMPLOYEE_ID'))
                                    {{ "Employee" }}
                                @elseif($lead->userDetails->role_id == Config::get('constant.ADMIN_ID'))
                                    {{ "Admin" }}
                                @endif
                            </td>
                            <td style="width: 13%">{{ $lead->userDetails->fullname." ".$lead->userDetails->lastname }}</td>
                            <td style="width: 12%">{{ $lead->project_name }}</td>
                            <td style="width: 10%">
{{--                                {{ $lead->currencies->simbol ."".number_format($lead->amount , 2) }}--}}
                            @if(isset($lead->currencies))
                                {{ $lead->currencies->simbol ."".number_format($lead->amount , 2) }}
                            @else
                                {{ "-" }}
                            @endif
                            </td>
                            <td style="width: 32%">
                                @if(strlen($lead->comment) > 0)
                                    {{ $lead->comment.' - '.$lead->userDetails->fullname." ".$lead->userDetails->lastname }}
                                @else
                                    {{ "-" }}
                                @endif
                            </td>
                            <td style="width: 32%">
                                @if( isset($lead->note->note_desc) )
                                    {{ $lead->note->note_desc.' - '.$lead->note->noteUser->fullname.$lead->note->noteUser->lastname}}
                                @else
                                    {{ '-' }}
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
            {{ $leads->render() }}
        </div>
    </div>
@endsection
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function ()
        {
            $.fn.datepicker.defaults.orientation = "bottom";
            $.fn.datepicker.defaults.format      = '{{ Config::get('constant.DATEPICKER_FORMAT') }}';
//            $('.end').datepicker();
            var d                                = new Date();
//            d.setDate(d.getDate()+1);
//            var date = d.getDate() + 1;
            $('.start').datepicker({
                endDate: d
            });
            $('.end').datepicker({
                endDate: d,
            });
            $('.start').on('change' , function ()
            {
                $('.end').val('');
            });
//            $('#bootstrap-table').bdt({
//                showSearchForm: 0,
//                showEntriesPerPageField: 0
//            });
        });
    </script>
@endsection


