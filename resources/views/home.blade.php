@extends('layouts.internal')

@section('content')
<div class="container">
<div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{ $data }}</h3>

          <p>Total Hotels customers</p>
        </div>

        <a href="Total_customer" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{{ $todays }}</h3>

          <p>Today's Visited Customers</p>
        </div>

        <a href="Todays_customer" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{{$Weeks}}</h3>

          <p>This Week's Customers</p>
        </div>

        <a href="Weeks_customer" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>{{$Months}}</h3>

          <p>This month's Customers</p>
        </div>

        <a href="Months_customer" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-primary text-white">
        <div class="inner">
          <h4>{{$booking}}/{{$totaloccupancy}}  ({{round($percent)}}%)</h4>
          <p> Avrage Bookings </p>
          <h4>{{round($rate)}}</h4>
          <p>Monthly Avrage RoomRent</p>
        </div>

        <a href="Monthly_Bill" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>

    </div>
    </div>
    {{-- <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-secondary text-white">
        <div class="inner">
          <h3>{{$rate}}</h3>

          <p>Monthly Avrage RoomRent</p>
        </div>

        <a href="Monthly_Bill" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div> --}}

    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>{{$mostVistited[0]->count}}</h3>
          <h3> {{ " \t \t "}}</h3>

          <p>Most Visited Customers</p>
        </div>

        <a href="MostVistited" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
</div>



 <!-- DONUT CHART -->
 <div class="card card-danger">
    <div class="card-header">
      <h3 class="card-title">Donut Chart</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>

    <head>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
          google.charts.load("current", {packages:["corechart"]});
          google.charts.setOnLoadCallback(drawChart);
          function drawChart() {
            var data = google.visualization.arrayToDataTable([
              ['city', 'count'],
              <?php echo $chartdata ?>
            ]);

            var options = {
              title: 'City Chart',
              pieHole: 0.4,
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
          }
        </script>
      </head>
    <div class="card-body"><div class="chartjs-size-monitor">
        <div class="chartjs-size-monitor-expand"><div class=""></div></div>
        <div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
    <div id="donutchart" style="width: 900px; height: 500px;"></div>
    <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block;" width="885" height="687" class="chartjs-render-monitor"></canvas>
    </div>
    <!-- /.card-body -->
  </div>
    <!-- /.card-body -->
  </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->



</div>


@endsection
