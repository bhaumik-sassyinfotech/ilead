{{--{{ dd($monthly) }}--}}

@extends('admin.layouts.app')

@section('content')
    <div class="row">

        <div class="col-sm-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="well">
                        <h4 class="text-danger">
                          <span class="label label-danger pull-right">
                            36%
                          </span>
                          <a href="#">Analytics 1 </a>
                        </h4>
                    </div>
                </div>
              <div class="col-md-3">
                <div class="well">
                  <h4 class="text-success">
                    <span class="label label-success pull-right">+ 33%</span>
                    <a href="#"> Analytics 2 </a>
                    </h4>
                </div>
              </div>
              <div class="col-md-3">
                <div class="well">
                  <h4 class="text-primary">
                    <span class="label label-primary pull-right">201</span>
                     <a href="#"> Analytics 3 </a>
                    </h4>
                </div>
              </div>
              <div class="col-md-3">
                <div class="well">

                  <h4 class="text-success">
                    @if($monthly['achieved'] == TRUE)
                          <span class="label label-success pull-right">
                        @else
                          <span class="label label-danger pull-right">
                    @endif
                        {{ $monthly['calculated'] }} out of {{ $monthly['target'] }}</span>
                     <a href="#"> Monthly target</a>
                  </h4>
                </div>
              </div>
            </div><!--/row-->
        </div><!--/col-12-->
    </div>
    <div class="row">
        <div class="col-md-6">
            <form action="{{ url('admin/dashboard') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group col-md-5">
                    <label for="start">Start Date:</label>
                    <input name="from_date" placeholder="Start date" type="text" value="{{ isset($from_date) ? date("d-m-Y" , strtotime($from_date)):'' }}" class="form-control start" id="start">
                </div>
                <div class="form-group col-md-5">
                    <label for="end">End Date:</label>
                    <input name="to_date" placeholder="End date" type="text" value="{{ isset($to_date) ? date("d-m-Y" , strtotime($to_date)):'' }}" class="form-control end" id="end">
                </div>
                <div class="col-md-2">
                    <label for="end">&nbsp;</label>
                    {{ Form::submit('Update',['class' => 'btn btn-success']) }}
                </div>
            </form>
        </div>
    </div>
    <div id="lineChartContainer" class="graph" ></div>

    <div id="barChartContainer" class="graph" ></div>

    <script type="text/javascript">
      var lineData = {!! $graph['lineChart'] !!};

      var lineChart=[];

      $.each(lineData, function( index, value ) {

          var date = new Date(value.date);
          var month = parseInt(date.getMonth());
          var day = parseInt(date.getUTCDate());
          var year = parseInt(date.getFullYear());
          var aa = new Date(year,month,day);
          //console.log(aa);
          var transaction_data= new Object();
          transaction_data.x = aa;
          transaction_data.y = value.tot_cnt;

          lineChart.push(transaction_data);

      });

      var barData  = {!! $graph['barChart'] !!};

      var barChart = [];
      $.each(barData, function( index, value ) {

          var date = new Date(value.date);
          var month = parseInt(date.getMonth());
          var day = parseInt(date.getUTCDate());
          var year = parseInt(date.getFullYear());
          var aa = new Date(year,month,day);
          //console.log(aa);
          var obj= new Object();
          obj.y = value.tot_amt;
          obj.label = aa;
//          obj.label = value.month_name;

          barChart.push(obj);

      });
        console.log(barChart);


      window.onload = function ()
      {
          var line = new CanvasJS.Chart( "lineChartContainer",
          {

              title: {
                  text: "Leads Analytics",
                  fontSize: 30
              },
              animationEnabled: true,
              axisX: {
                  gridColor: "Silver",
                  tickColor: "silver",
                  interval: 1,
                  intervalType: "day",
                  valueFormatString: "DD-MMM",
                  labelFormatter: function(e){
                      if(e.value % 10 == 0)
                      {
                          return CanvasJS.formatDate( e.value, "DD-MMM");
                      }
                  }
//                  valueFormatString: "DD-MMM-Y"
              },
              toolTip: {
//                  shared: true
                  content: "{x}<br/> <span style='\"'color: {color};'\"'>{name}</span>: {y}",
              },
              theme: "theme1",
              axisY: {
                  gridColor: "Silver",
                  tickColor: "silver"
              },
              legend: {
                  verticalAlign: "center",
                  horizontalAlign: "right"
              },
              data: [
                  {
                      type: "line",
                      showInLegend: true,
                      lineThickness: 2,
                      name: "Leads",
                      markerType: "circle",
                      color: "#09C",
                      dataPoints: lineChart
                  },


              ],
              legend: {
                  cursor: "pointer",
                  itemclick: function ( e )
                  {
                      if ( typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible )
                      {
                          e.dataSeries.visible = false;
                      }
                      else
                      {
                          e.dataSeries.visible = true;
                      }

                      line.render();
                  }
              }
          } );

          var bar = new CanvasJS.Chart("barChartContainer", {
              animationEnabled: true,
              theme: "light1", // "light1", "light2", "dark1", "dark2"
              title:{
                  text: "Converted Leads"
              },
              axisY: {
                  title: "Amount"
              },
              axisX: {
                  title: "Time",
                  gridColor: "Silver",
                  tickColor: "silver",
//                  interval: 1,
//                  intervalType: "day",
                  valueFormatString: "MMM"
              },
              data: [{
                  type: "column",
                  showInLegend: true,
                  legendMarkerColor: "#09c",
                  color: "#09C",
                  legendText: "Amount of Converted Leads",
                  dataPoints: barChart
              }]
          });
          bar.render();
          line.render();

      };

      var js_dateFormat = '{{ Config::get('constant.JS_DATETIME_FORMAT') }}';
      $(function ()
      {
          $.fn.datepicker.defaults.orientation = "bottom";
          $.fn.datepicker.defaults.format      = '{{ Config::get("constant.DATEPICKER_FORMAT") }}';

          var d                                = new Date();
          $('.start').datepicker({
              endDate: d
          });
          $('.end').datepicker({
              endDate: d
          });
          $('.start').on('change' , function (e)
          {
//                var currDate = new Date($(this).val());
//                console.log(currDate);
//                         .datepicker( { startDate: currDate } );
              $('.end').val('');
          });
      });

</script>
@endsection
