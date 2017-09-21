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
                    <span class="label label-success pull-right">+ 24%</span>  
                     <a href="#"> Analytics 4 </a>
                  </h4>
                </div>
              </div>
            </div><!--/row-->    
        </div><!--/col-12-->
    </div>
    <div id="chartContainer" class="graph" >
  </div>
  <script type="text/javascript">
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
                        valueFormatString: "DD/MMM"

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
                        name: "Visits",
                        markerType: "square",
                        color: "#F08080",
                        dataPoints: [
                        { x: new Date(2010,0,3), y: 650 },
                        { x: new Date(2010,0,5), y: 700 },
                        { x: new Date(2010,0,7), y: 710 },
                        { x: new Date(2010,0,9), y: 658 },
                        { x: new Date(2010,0,11), y: 734 },
                        { x: new Date(2010,0,13), y: 963 },
                        { x: new Date(2010,0,15), y: 847 },
                        { x: new Date(2010,0,17), y: 853 },
                        { x: new Date(2010,0,19), y: 869 },
                        { x: new Date(2010,0,21), y: 943 },
                        { x: new Date(2010,0,23), y: 970 }
                        ]
                  },
                  {        
                        type: "line",
                        showInLegend: true,
                        name: "Unique Visits",
                        color: "#20B2AA",
                        lineThickness: 2,

                        dataPoints: [
                        { x: new Date(2010,0,3), y: 510 },
                        { x: new Date(2010,0,5), y: 560 },
                        { x: new Date(2010,0,7), y: 540 },
                        { x: new Date(2010,0,9), y: 558 },
                        { x: new Date(2010,0,11), y: 544 },
                        { x: new Date(2010,0,13), y: 693 },
                        { x: new Date(2010,0,15), y: 657 },
                        { x: new Date(2010,0,17), y: 663 },
                        { x: new Date(2010,0,19), y: 639 },
                        { x: new Date(2010,0,21), y: 673 },
                        { x: new Date(2010,0,23), y: 660 }
                        ]
                  }

                  
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
