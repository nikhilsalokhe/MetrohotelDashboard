@extends('layouts.internal')

@section('content')
<h1> Total Customers</h1>
{{-- Search Bar --}}
<div>
    <div class="mx-auto pull-right">
        <div class="">
            <form action=" " method="GET" role="search">

                <div class="input-group">
                    {{-- <span class="input-group-btn mr-5 mt-1">
                        <button class="btn btn-info" type="submit" title="Search projects">
                            <span class="fas fa-search"></span>
                        </button>
                    </span> --}}
                    <input type="search" class="form-control mr-1" name="search" placeholder="Search" />
                    <span class="input-group-btn mr-5 mt-1">
                        <button class="btn btn-info" type="submit" title="Search ">
                            <span class="fas fa-search"></span>
                        </button>
                    </span>

                    <a href="../Total_customer" class=" mt-1">
                        <span class="input-group-btn">
                            <button class="btn btn-danger" type="button" title="Refresh page">
                                <span class="fas fa-sync-alt"></span>
                            </button>
                        </span>
                    </a>

                </div>
            </form>
        </div>
    </div>
</div>

{{-- {{$data}} --}}
<div class="card-body">
    <table id="example2" class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>Customer ID</th>
        <th>customer Name</th>
        <th>Address</th>
        {{-- <th>Last Visit Details</th> --}}
        <th>Phone No.</th>
      </tr>
      @foreach ($data as $key )
    </thead>
    <tbody>
      <tr>
        <td>{{$key->Customer_Id}}</td>
        <td>{{$key->Guest_name}}</td>
        <td> {{$key->Address}}</td>
        {{-- <td></td> --}}
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
