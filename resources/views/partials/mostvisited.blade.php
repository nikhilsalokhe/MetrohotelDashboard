@extends('layouts.internal')

@section('content')
<h1> Most visited customers</h1>
{{-- {{$data}} --}}
<div class="card-body">
    <table id="example2" class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>Customer_Id</th>
        <th>customer Name</th>

        <th>Visited Time</th>
      </tr>
      @foreach ($mostVistited as $key )
    </thead>
    <tbody>
      <tr>
        <td>{{$key->Customer_Id}}</td>
        <td>{{$key->Guest_name}}</td>

        <td>{{$key->count}}</td>
      </tr>
    </tbody>
      @endforeach
    </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection
