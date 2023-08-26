{{-- @extends('layouts.internal') --}}
@extends('voucher.layouts.app')

@section('content')
    <div class="card m-2 border">
        <div class="card-header" style="background-color: rgb(215, 221, 228)">
            @include('backbutton')
            <h1 class="text-center mb-2"> Today's Customers</h1>
            <h3 class="text-center mb-3">{{ $todayscount }}</h3>
        </div>
        <div class="card-body">
            <table id="data-table-basic" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Customer ID</th>
                        <th>Room No.</th>
                        <th>Room Type</th>
                        <th>customer Name</th>
                        <th>Address</th>
                        <th>Phone No.</th>
                    </tr>
                    @foreach ($data as $key)
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $key->Customer_Id }}</td>
                        <td>{{ $key->Room_no }}</td>
                        <td>{{ $key->Room_name }}</td>
                        <td>{{ $key->Guest_name }}</td>
                        <td> {{ $key->Address }}</td>
                        <td>{{ $key->Phone_no }}</td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#data-table').DataTable({
                "iDisplayLength": 25 // Set the default number of records to display

            });
        });
    </script>
@endsection
