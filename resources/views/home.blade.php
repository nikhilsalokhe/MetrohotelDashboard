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
          <h3>{{$booking}}/{{$totaloccupancy}}</h3>

          <p> Avrage Bookings </p>
        </div>

        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-secondary text-white">
        <div class="inner">
          <h3>{{$rate}}</h3>

          <p>Monthly Avrage RoomRent</p>
        </div>

        <a href="Monthly_Bill" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>{{$mostVistited[0]->count}}</h3>

          <p>Most Visited Customers</p>
        </div>

        <a href="MostVistited" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>
</div>

@endsection
