@extends('admin.layouts.app')

@section('content')
    @if(session()->has('error'))
    <div class="alert alert-success">
        {{ session()->get('error') }}
    </div>
    @endif
    
	<div>
		<div class="col-md-6 nopadding"><h3 class="page-title">MemberShip Plan</h3></div>
		<div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/home') }}">Dashboard</a> > MemberShip Plan</p></div>
	</div>
	
    <?php $menu = json_decode(Auth::user()->role->permissions,true)?>
    
	<div class="new_button">
		<div class="pull-right">
			<a href="#" class="btn btn-danger delete_all extra_button" id="deleteData">Delete selected</a>
		</div>
		@if($menu['users.manage']=='true')
			<div class="pull-right">
				<a href="{{ route('plans.create') }}" class="btn btn-success extra_button">Add new</a>
			</div>
		@endif
		<div style="clear: both;"></div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            MemberShip Plan List
        </div>
        <div class="col-lg-4" style="margin: 10px 10px 10px 0px">
            <form action="{{ url('/admin/searchPlans') }}" method="POST" role="search">
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="text" class="form-control" name="q"
                        placeholder="Search plans" value="{{ isset($q)? $q : '' }}"> 
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-default">
                                <span class="fa fa-search"></span>
                            </button>
                        </span>
                    <div class="input-group" style="margin-left: 10px">
                        <span class="input-group-btn">
                            <a  href="{{ route('plans.index') }}" 
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
                        <th style="text-align:center;">
                            <input type="checkbox"  id="master"  value="all" />
                        </th>
                        <th>ID</th>
                        <th>Plan Name</th>
                        <th>Plan Price(Monthly)</th>
                        <th>Plan Price(Annual)</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($plans) && count($plans) > 0)
                        <?php $i = 0; ?>
                        @foreach ($plans as $plan)
                            <tr>
                                <td style="text-align:center;">
                                    <input  type="checkbox" name="checkbox[]" data-id="{{$plan->id}}" class="sub_chk" />
                                </td>                        
                                <td>{{ $plan->id }}</td>
                                <td>{{ $plan->name }}</td>
                                <td>{{ $plan->subscription_period }}</td>
                                <td>{{ $plan->subscription_perice }}</td>
                                <td>
                                    @if($plan->status > 0)  Active 
                                    @else Deactive
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('plans.show',[$plan->id]) }}" class="btn btn-xs btn-primary">View</a>
                                    @if($menu['users.manage']=='true')
                                        <a href="{{ route('plans.edit',[$plan->id]) }}" class="btn btn-xs btn-info">Edit</a>{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("Are you sure?")."');",
                                        'route' => ['plans.destroy', $plan->id])) !!}
                                        {!! Form::submit('Delete', array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7"><p style="text-align: center;"><b>No Record Found.</b></p></td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="col-lg-6"></div>
            <div class="col-lg-6">
                    @if(isset($plans)) {!! $plans->render() !!} @endif
            </div>            
        </div>
    </div>
@stop

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function () {

            $('#master').on('click', function(e) {
             if($(this).is(':checked',true))  
             {
                $(".sub_chk").prop('checked', true);  
             } else {  
                $(".sub_chk").prop('checked',false);  
             }  
            });
        });

        $('.delete_all').on('click', function(e) {

            var allVals = [];  
            $(".sub_chk:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            });  

            if(allVals.length <=0)  
            {  
                alert("Please select row.");  
            }  else {  

                var check = confirm("Are you sure you want to delete this row?");  
                if(check == true){  

                    var join_selected_values = allVals.join(",");
                    $.ajax({
                        url: '{!! route('plans.mass_destroy') !!}',
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+join_selected_values,
                        success: function (data) {
                            if (data['success']) {
                                $(".sub_chk:checked").each(function() {  
                                    $(this).parents("tr").remove();
                                });
                                console.log('success');
                            } else if (data['error']) {
                                console.log('error');
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });

                  $.each(allVals, function( index, value ) {
                      $('table tr').filter("[data-row-id='" + value + "']").remove();
                  });
                }  
            }  
        });
    </script>
@endsection