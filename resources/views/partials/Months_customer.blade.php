{{-- @extends('layouts.internal') --}}
@extends('voucher.layouts.app')
@section('content')

    <head>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="http://code.jquery.com/ui/1.9.2/themes/smoothness/jquery-ui.css" rel="stylesheet" />
        <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
        <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    </head>
    <div class="card m-2 border">
        <div class="card-header text-center">
            @include('backbutton')
            <div class="row">
                <div class="col">
                    <h3>{{ $formattedMonth }} Customers {{ $monthTotal }}</h3>
                </div>
                <div class="col">
                    <div class="container">
                        <h5 class="">Select Custom Month</h5>
                        <div class="d-flex justify-content-center">
                            <form class="form-inline" action="{{ url('/custom_month') }}"  method="GET">
                                <div class="form-group">
                                    <label for="custom_month" class="mr-2">Month:</label>
                                    <input class="form-control" type="month" id="custom_month" name="custom_month" value="{{ request('custom_month') ? request('custom_month') : now()->format('Y-m') }}">
                                </div>
                                <button type="submit" class="btn btn-sm btn-success ml-2">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Custom Date --}}


        {{-- <div class="float-right">
        <div class="">

            <form action="{{ url('findCustomer') }}" method="GET" role="search">

                <div class="input-group ,text-center ">
                    <input type="text" name="start_date" id="datepicker" placeholder="Start " value={{$start}} >
                    <input type="text" name="end_date" id="datepicker1" placeholder="End" value= {{$end}}>
                    <button class="btn btn-info" type="submit"> find </button>

                    <a href="{{ url('findCustomer?start_date= ') }}" class=" mt-1">
                        <span class="input-group-btn">
                            <button class="btn btn-danger" type="button" title="Refresh page">
                                <span class="fas fa-sync-alt"></span>
                            </button>
                        </span>
                    </a>
                </div>

            </form>

        </div>
        </div> --}}

        {{-- end custom date --}}


        {{-- {{$data}} --}}
        <div class="card-body">
            <table id="data-table" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Customer ID</th>
                        <th>Customer Name</th>
                        <th>Arrival Date Time</th>
                        <th>Depart</th>
                        <th>Room No</th>
                        <th>Address</th>
                        <th>Phone No.</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key)
                        <tr>
                            <td>{{ $key->customer_id }}</td>
                            <td>{{ $key->customer_name }}</td>
                            <td> {{ \Carbon\Carbon::parse($key->ARRIVAL)->format('d-m-Y h:i A') }}</td>
                            <td> {{ \Carbon\Carbon::parse($key->DEPART)->format('d-m-Y h:i A') }}</td>
                            <td> {{ $key->ROOM }}</td>
                            <td> {{ $key->address }}</td>
                            <td>{{ $key->phone_no }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <script type="text/javascript">
        $(function() {
            $("#datepicker").datepicker({
                maxDate: new Date()
            });
            $("#datepicker1").datepicker({
                maxDate: new Date()
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script>
         $(document).ready(function() {
             $('#data-table').DataTable({
                 "iDisplayLength": 25 // Set the default number of records to display
 
             });
         });
     </script>
@endsection
