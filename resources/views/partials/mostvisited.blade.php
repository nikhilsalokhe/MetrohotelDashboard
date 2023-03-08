@extends('layouts.internal')

@section('content')
<h1 class= "text-center"> Most visited customers</h1>
{{-- {{$data}} --}}
<div class="card-body">
    <table id="example2" class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>Customer_Id</th>
        <th>customer Name</th>
         <th>Visites</th>
         {{-- <th>Days of Stay</th>
         <th>Total Revinue</th> --}}
         <th>More Details</th>
      </tr>
      @foreach ($mostVistited as $key )
    </thead>
    <tbody>
      <tr>
        <td>{{$key->Customer_Id}}</td>
        <td>{{$key->Guest_name}}</td>
        <td>{{$key->count}}</td>
        <td>
            <a type="button" class="btn btn-sm btn-default" href="{{url('details/'.$key->Customer_Id) }}" >
                <i class="fas fa-eye"></i>
              </a>
        </td>
      </tr>
    </tbody>
      @endforeach
    </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection
