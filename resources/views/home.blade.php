@extends('layouts.internal')

@section('content')
<div class="container">
<div class="row">
    <div class="col-lg-2 col-4">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>count</h3>

          <marquee>Total Hotels customers</marquee>
        </div>
        
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-4">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>count<sup style="font-size: 20px"></sup></h3>

          <marquee>Today's Visited Customers</marquee>
        </div>
       
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-4">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>count</h3>

          <marquee>This Week's Customers</marquee>
        </div>
        
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-4">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>count</h3>

          <marquee>This month's Customers</marquee>
        </div>
        
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-2 col-4">
      <!-- small box -->
      <div class="small-box bg-primary text-white">
        <div class="inner">
          <h3>count</h3>

          <marquee>Monthly Avrage Bookings </marquee>
        </div>
        
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-2 col-4">
      <!-- small box -->
      <div class="small-box bg-secondary text-white">
        <div class="inner">
          <h3>count</h3>

          <marquee>Monthly Avrage RoomRent</marquee>
        </div>
        
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>
</div>

@endsection
