{{-- @extends('layouts.internal') --}}
@extends('voucher.layouts.app')

@section('content')

    <head>
        <link href="http://code.jquery.com/ui/1.9.2/themes/smoothness/jquery-ui.css" rel="stylesheet" />
        <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
        <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    </head>
    <div class="card m-2 border">
        <div class="card-header" style="background-color: rgb(215, 221, 228)">
            @include('backbutton')
            <h1 class="text-center mb-2"> Total This Week's Customers</h1>
            <h3 class="text-center mb-3">{{ $weekscount }}</h3>
        </div>
            {{-- Custom Date --}}


            {{-- <div class="float-right">
        <div class="">

            <form action="{{ url('one_day_details') }}" method="GET" role="search">

                <div class="input-group ,text-center ">
                    <input type="text" name="start_date" id="datepicker" placeholder="start " value="{{$start ? $start : ''}}" />
                    <button class="btn btn-info" type="submit"> find </button>

                    <a href="{{ url('one_day_details?start_date=') }}" class=" mt-1">
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
                <table id="data-table-basic" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Customer ID</th>
                            <th>customer Name</th>
                            <th>Arrival date time</th>
                            <th>Departre date time</th>
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
                                <td>{{ \Carbon\Carbon::parse($key->ARRIVAL)->format('d-m-Y h:i A') }}</td>
                                <td>{{ \Carbon\Carbon::parse($key->DEPART)->format('d-m-Y h:i A') }}</td>
                                <td>{{ $key->ROOM }}</td>
                                <td> {{ $key->address }}</td>
                                <td>{{ $key->phone_no }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
            <!-- /.card-body -->
        </div>
        {{-- Card End --}}
        <script>
            $('#datepicker').datepicker({
                minDate: '-7d',
                maxDate: new Date()
            });
        </script>
        <!-- /.card -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#data-table').DataTable({
                    "iDisplayLength": 25 // Set the default number of records to display
    
                });
            });
        </script>
        <!-- /.card -->
    @endsection
