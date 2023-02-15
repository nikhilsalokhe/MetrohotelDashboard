{{-- {{$details1->Guest_name}}

@foreach ($details as $item)
    {{$item->Guest_name}}
{{$item->Arrival_DT}}
@endforeach
{{$details->sum('DAYS')}} --}}


@extends('layouts.internal')

@section('content')
<h1>Guest History</h1>
{{-- Search Bar --}}
{{-- {{$data}} --}}
<div class="card-body">
    <table id="example2" class="table table-bordered table-hover">
    <thead>
        customer Name :{{$details1->Guest_name}}
      <tr>


        <th>Arrival Date and Time</th>
        <th>Departure Date And Time</th>
        <th>Bill Amount</th>
        <th>Days of stay</th>

      </tr>
      @foreach ($details as $item)
    </thead>
    <tbody>
      <tr>
        <td>{{$item->Arrival_DT}}</td>
        <td>{{$item->DEPART}}</td>
        <td>{{$item->Bill_amount}}</td>
        <td>{{$item->DAYS}}</td>
      </tr>
    </tbody>
      @endforeach
      <td></td>
      <td></td>
      <td>Total Bill Amount={{$details->sum('Bill_amount')}}
        <p>ARR:{{round($details->sum('Bill_amount')/$details->sum('DAYS'))}}</p></td>
      <td> Total Days of stay:  {{$details->sum('DAYS')}}</td>
    </table>
 {{-- <td> Total Days of stay:  {{$details->sum('DAYS')}}</td>
  <td>Average Room Rent={{$details->sum('Bill_amount')/$details->sum('DAYS')}}</td> --}}
  {{-- Average Room Rent :  {{$a}} --}}
  </div>
<!-- /.card -->
@endsection

