{{--{{ dd($internationalLeads) }}--}}
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
        <div class="col-md-6 nopadding"><h3 class="page-title">International Leads</h3></div>
        <div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/dashboard') }}">Dashboard</a>
                > International Leads</p></div>
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
            <form action="{{ route('international.searchLead') }}" method="POST" role="search">
                {{ csrf_field() }}
                
                <div class="row">
                    <div class="col-md-4">
                        <input value="{{ isset($start) ?date("d-m-Y" , strtotime($start)):'' }}" name="start"
                               type="text" class="form-control start">
                    </div>
                    <div class="col-md-4">
                        <input value="{{ isset($end) ? date("d-m-Y" , strtotime($end)):'' }}" name="end" type="text"
                               class="form-control end">
                    </div>
                    <div class="col-md-4 input-group">
                        <input type="text" class="form-control" name="q" value="{{ isset($query)? $query : '' }}">
                        
                        <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">
                        <span class="fa fa-search"></span>
                    </button>
                </span>
                        <div class="input-group" style="margin-left: 10px">
                    <span class="input-group-btn">
                        <a href="{{ route('international.index') }}"
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
                    <th>Project Name</th>
                    <th>Amount</th>
                    <th>Comment</th>
                    <th>Notes</th>
                    <th>Actions</th>
                </tr>
                </thead>
                @if (isset($internationalLeads) && count($internationalLeads) > 0)
                    <?php  $i = 0; ?>
                    
                    @foreach ($internationalLeads as $lead)
                        <tr>
                            <td style="width: 5%">{{ ++$i }}</td>
                            <td style="width: 10%">{{ $lead->project_name }}</td>
                            <td style="width: 10%">{{ $lead->currencies->simbol ."".number_format($lead->amount , 2) }}</td>
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
                            <td style="width: 11%">
                                @if($perm->update == 'TRUE')
                                    <a href="{{ route('international.edit',[$lead->lead_id]) }}"
                                       class="btn btn-xs btn-info"> Edit </a>
                                @endif
                                @if($perm->delete == 'TRUE')
                                    {{ Form::open(array(
                                      'style' => 'display: inline-block;',
                                      'method' => 'DELETE',
                                      'onsubmit' => "return confirm('".trans("Are you sure want to delete this lead?")."');",
                                      'route' => ['international.destroy', $lead->lead_id])) }}
                                    {{ Form::submit('Delete', array('class' => 'btn btn-xs btn-danger')) }}
                                    {{ Form::close() }}
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
            {{ $internationalLeads->render() }}
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
//                todayHighlight: true
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


