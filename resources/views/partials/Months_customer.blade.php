@extends('layouts.internal')

@section('content')
<h1> Total this months Customers</h1>
{{-- {{$data}} --}}
<div class="card-body">
    <table id="example2" class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>Customer ID</th>
        <th>customer Name</th>
        <th>Address</th>
        <th>Phone No.</th>
      </tr>
      @foreach ($data as $key )
    </thead>
    <tbody>
      <tr>
        <td>{{$key->Customer_Id}}</td>
        <td>{{$key->Guest_name}}</td>
        <td> {{$key->Address}}</td>
        <td>{{$key->Phone_no}}</td>
      </tr>
    </tbody>
      @endforeach
    </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection
