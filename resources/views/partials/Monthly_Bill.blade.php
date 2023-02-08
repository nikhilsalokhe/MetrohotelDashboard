@extends('layouts.internal')

@section('content')
{{-- {{$data}} --}}
<div class="card-body">
    <table id="example2" class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>Months</th>
        <th>Average Room Rate</th>
    </thead>
    <tbody>
      <tr>
        <td>December21</td>
        <td>{{$December21}}</td>
      </tr>
      <tr>
        <td>January22</td>{{--<td>3:6</td> --}}
        <td>{{$January22}}</td>
      </tr>
      <tr>
        <td>February22</td>{{-- <td>6:9</td> --}}
        <td>{{$February22}}</td>
      </tr>
      <tr>
        <td>March22</td>{{-- <td>9:12</td> --}}
        <td>{{$March22}}</td>
      </tr>
      <tr>
        <td>April22</td>{{-- <td>12:15</td> --}}
        <td>{{$April22}}</td>
      </tr>
      <tr>
        <td>May22</td>{{-- <td>15:18</td> --}}
        <td>{{$May22}}</td>
      </tr>
      <tr>
        <td>June22</td> {{-- <td>18:21</td> --}}
        <td>{{$June22}}</td>
      </tr>
      <tr>
        <td>July22</td>{{-- <td>21:24</td> --}}
        <td>{{$July22}}</td>
      </tr>

      <tr>
        <td>August22</td>{{-- <td>21:24</td> --}}
        <td>{{$August22}}</td>
      </tr>
      <tr>
        <td>September22</td>{{-- <td>21:24</td> --}}
        <td>{{$September22}}</td>
      </tr>
      <tr>
        <td>October22</td>{{-- <td>21:24</td> --}}
        <td>{{$October22}}</td>
      </tr>
      <tr>
        <td>November22</td>{{-- <td>21:24</td> --}}
        <td>{{$November22}}</td>
      </tr>
      <tr>
        <td>December22</td>{{-- <td>21:24</td> --}}
        <td>{{$December22}}</td>
      </tr>
      <tr>
        <td>January23</td>{{-- <td>21:24</td> --}}
        <td>{{$January23}}</td>
      </tr>
    </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection


