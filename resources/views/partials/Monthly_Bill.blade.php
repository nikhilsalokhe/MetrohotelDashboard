@extends('layouts.internal')

@section('content')
{{-- {{$data}} --}}
<div class="card-body">
    <table id="example2" class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>Months</th>
        <th>Average Room Rate<br>Month bill amt/stay days</th>
        <th>Average Bookings<br>Total stay days/Monthly stay days</th>
        <th>Booking Percentage<br>(Total stay days/Monthly stay days)*100 </th>
    </thead>
    <tbody>
      <tr>
        <td>December21</td>
        <td>{{round($December21)}}</td>
        <td>{{$December21r}}/930</td>
        <td>{{round(($December21r/930)*100)}}%</td>
      </tr>
      <tr>
        <td>January22</td>{{--<td>3:6</td> --}}
        <td>{{round($January22)}}</td>
        <td>{{$January22r}}/930</td>
        <td>{{round(($January22r/930)*100)}}%</td>
      </tr>
      <tr>
        <td>February22</td>{{-- <td>6:9</td> --}}
        <td>{{round($February22)}}</td>
        <td>{{$February22r}}/840</td>
        <td>{{round(($February22r/840)*100)}}%</td>
      </tr>
      <tr>
        <td>March22</td>{{-- <td>9:12</td> --}}
        <td>{{round($March22)}}</td>
        <td>{{$March22r}}/900</td>
        <td>{{round(($March22r/900)*100)}}%</td>
      </tr>
      <tr>
        <td>April22</td>{{-- <td>12:15</td> --}}
        <td>{{round($April22)}}</td>
        <td>{{$April22r}}/930</td>
        <td>{{round(($April22r/930)*100)}}%</td>

      </tr>
      <tr>
        <td>May22</td>{{-- <td>15:18</td> --}}
        <td>{{round($May22)}}</td>
        <td>{{$May22r}}/900</td>
        <td>{{round(($May22r/900)*100)}}%</td>
      </tr>
      <tr>
        <td>June22</td> {{-- <td>18:21</td> --}}
        <td>{{round($June22)}}</td>
        <td>{{$June22r}}/930</td>
        <td>{{round(($June22r/930)*100)}}%</td>
      </tr>
      <tr>
        <td>July22</td>{{-- <td>21:24</td> --}}
        <td>{{round($July22)}}</td>
        <td>{{$July22r}}/900</td>
        <td>{{round(($July22r/900)*100)}}%</td>
      </tr>

      <tr>
        <td>August22</td>{{-- <td>21:24</td> --}}
        <td>{{round($August22)}}</td>
        <td>{{$August22r}}/930</td>
        <td>{{round(($August22r/930)*100)}}%</td>
      </tr>
      <tr>
        <td>September22</td>{{-- <td>21:24</td> --}}
        <td>{{round($September22)}}</td>
        <td>{{$September22r}}/900</td>
        <td>{{round(($September22r/900)*100)}}%</td>
      </tr>
      <tr>
        <td>October22</td>{{-- <td>21:24</td> --}}
        <td>{{round($October22)}}</td>
        <td>{{$October22r}}/930</td>
        <td>{{round(($October22r/930)*100)}}%</td>
      </tr>
      <tr>
        <td>November22</td>{{-- <td>21:24</td> --}}
        <td>{{round($November22)}}</td>
        <td>{{$November22r}}/900</td>
        <td>{{round(($November22r/900)*100)}}%</td>
      </tr>
      <tr>
        <td>December22</td>{{-- <td>21:24</td> --}}
        <td>{{round($December22)}}</td>
        <td>{{$December22r}}/930</td>
        <td>{{round(($December22r/930)*100)}}%</td>
      </tr>
      <tr>
        <td>January23</td>{{-- <td>21:24</td> --}}
        <td>{{round($January23)}}</td>
        <td>{{$January23r}}/930</td>
        <td>{{round(($January23r/930)*100)}}%</td>
      </tr>
      <tr>
        <td>February23</td>{{-- <td>6:9</td> --}}
        <td>{{round($February23)}}</td>
        <td>{{$February23r}}/840</td>
        <td>{{round(($February23r/840)*100)}}%</td>
      </tr>
    </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection


