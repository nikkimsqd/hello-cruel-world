@extends('layouts.boutique')
@extends('admin.sections')


@section('content')

<section class="content">
  <div class="row">

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{$orderCount}}</h3>

          <p>SALES</p>
        </div>
        <div class="icon">
          <i class="ion ion-pricetags"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{$orderCount}}</h3>

          <p>ORDERS</p>
        </div>
        <div class="icon">
          <i class="ion ion-android-cart"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{$customerCount}}</h3>

          <p>CUSTOMERS</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-stalker"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-red">
        <div class="inner">
          <h3>{{$boutiqueCount}}</h3>

          <p>BOUTIQUES</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

  </div>

  <div class="row">
    <div class="col-md-12">

      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><b>SALES</b></h3>

          <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-hover" id="orders-table">
            <thead>
            <tr>
              <th class="align-center">Order ID</th>
              <th>Boutique Name</th>
              <th class="align-center">Status</th>
              <th class="align-center">Total</th>
              <th class="align-center">Boutique's revenue</th>
              <th class="align-center">Hinimo's revenue</th>
            </tr>
            </thead>
            <?php $totalRevenue = 0; ?>
            @foreach($orders as $order)
              @if($order['status'] == 'Completed')
              <tr>
                <td class="align-center">{{$order['id']}}</td>
                <td>{{$order->boutique['boutiqueName']}}</td>
                <td class="align-center">
                  @if($order['status'] == "In-Progress")
                  <span class="label label-warning">{{$order['status']}}</span>

                  @elseif($order['status'] == "For Alterations")
                  <span class="label label-info">{{$order['status']}}</span>

                  @elseif($order['status'] == "For Pickup")
                  <span class="label bg-navy">{{$order['status']}}</span>

                  @elseif($order['status'] == "For Delivery")
                  <span class="label bg-olive">{{$order['status']}}</span>

                  @elseif($order['status'] == "On Delivery")
                  <span class="label bg-maroon">{{$order['status']}}</span>

                  @elseif($order['status'] == "Delivered")
                  <span class="label label-success">{{$order['status']}}</span>

                  @elseif($order['status'] == "Completed")
                  <span class="label label-success">{{$order['status']}}</span>
                  @endif
                </td>
                <td class="align-center">₱{{$order['total']}}</td>
                <td class="align-center">₱{{$order['boutiqueShare']}}</td>
                <td class="align-center">₱{{$order['adminShare']}}</td>
              </tr>
              <?php $totalRevenue += $order['adminShare']; ?>
              @endif
            @endforeach
            <tr class="total">
              <td colspan="5">&nbsp; Total Revenue for this month</td>
              <td class="align-center"><b>₱{{$totalRevenue}}</b></td>
            </tr>
          </table>
        </div>
        <div class="box-footer" style="text-align: right;">
        </div>
      </div>

      <!-- <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Bar Chart</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="chart">
            <canvas id="barChart" style="height: 230px; width: 467px;" width="467" height="230"></canvas>
          </div>
        </div>
      </div> -->
    </div>
  </div>



</section>
@endsection


@section('scripts')
<script type="text/javascript">

$('.dashboard').addClass("active");  

  $(function () {
//-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var barChartData                     = areaChartData
    barChartData.datasets[1].fillColor   = '#00a65a'
    barChartData.datasets[1].strokeColor = '#00a65a'
    barChartData.datasets[1].pointColor  = '#00a65a'
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
})
</script>

@endsection