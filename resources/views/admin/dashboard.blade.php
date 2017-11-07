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
    <div id="chartContainer" class="graph" >
  </div>
  <script type="text/javascript">
      var graphData = {!! $graphData !!};
//        console.log(graphData);
      var leads=[];

      $.each(graphData, function( index, value ) {

          var date = new Date(value.date);
          var month = parseInt(date.getMonth());
          var day = parseInt(date.getUTCDate());
          var year = parseInt(date.getFullYear());
          var aa = new Date(year,month,day);
          //console.log(aa);
          var transaction_data= new Object();
          transaction_data.x = aa;
          transaction_data.y = value.tot_cnt;

          leads.push(transaction_data);

      });

//console.log(leads);

      window.onload = function () {
            var chart = new CanvasJS.Chart("chartContainer",
            {

                  title:{
                        text: "Site Analytics",
                        fontSize: 30
                  },
                        animationEnabled: true,
                  axisX:{
                        gridColor: "Silver",
                        tickColor: "silver",
                          interval: 1,
                          intervalType: "day",
                        valueFormatString: "DD-MMM-Y"

                  },
                        toolTip:{
                          shared:true
                        },
                  theme: "theme2",
                  axisY: {
                        gridColor: "Silver",
                        tickColor: "silver"
                  },
                  legend:{
                        verticalAlign: "center",
                        horizontalAlign: "right"
                  },
                  data: [
                  {
                        type: "line",
                        showInLegend: true,
                        lineThickness: 2,
                        name: "Leads",
                        markerType: "square",
                        color: "#09C",
                        dataPoints: leads
                  },


                  ],
          legend:{
            cursor:"pointer",
            itemclick:function(e){
              if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                  e.dataSeries.visible = false;
              }

              chart.render();
            }
          }
            });

chart.render();
}
</script>
@endsection
