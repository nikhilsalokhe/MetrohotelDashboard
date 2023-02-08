@extends('layouts.internal')

@section('content')
{{-- {{$data}} --}}
<div class="card-body">
    <table id="example2" class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>Checkin Slots</th>
        <th>No.of Checkins</th>
    </thead>
    <tbody>
      <tr>
        <td>12:00AM To 00:03AM</td>
        <td>{{$time1}}</td>
      </tr>
      <tr>
        <td>03:00AM To 06:0AM</td>{{--<td>3:6</td> --}}
        <td>{{$time2}}</td>
      </tr>
      <tr>
        <td>06:00AM To 09:00AM</td>{{-- <td>6:9</td> --}}
        <td>{{$time3}}</td>
      </tr>
      <tr>
        <td>09:00AM To 12:00PM</td>{{-- <td>9:12</td> --}}
        <td>{{$time4}}</td>
      </tr>
      <tr>
        <td>12:00PM To 03:00PM</td>{{-- <td>12:15</td> --}}
        <td>{{$time5}}</td>
      </tr>
      <tr>
        <td>03:00PM To 06:00PM</td>{{-- <td>15:18</td> --}}
        <td>{{$time6}}</td>
      </tr>
      <tr>
        <td>06:00PM To 09:00PM</td> {{-- <td>18:21</td> --}}
        <td>{{$time7}}</td>
      </tr>
      <tr>
        <td>09:00PM To 12:00PM</td>{{-- <td>21:24</td> --}}
        <td>{{$time8}}</td>
      </tr>
    </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection

