@extends('voucher.layouts.app')
@section('content')
<div class="card m-2 border">
    <div class="card-header" style="background-color: rgb(215, 221, 228)">
            @include('backbutton')
    <h1 class="text-center">Customer Booking Entries</h1>
    <h3 class="text-center">{{ $customer_history_count }}</h3>
    </div>

    {{-- <div class="container">
        <form action="{{ url('findCustomer1') }}" method="GET" role="search">

            <div class="text-center">
                <input type="date" class="" name="start_date" id="datepicker" placeholder="Start" max="{{ Carbon\Carbon::now()->toDateString() }}">
                <input type="date" name="end_date" id="datepicker1" placeholder="End" max="{{ Carbon\Carbon::now()->toDateString() }}">
                <button class="btn btn-primary" type="submit"> Search </button>
            </div>
        </form>
    </div> --}}
    <div class="card-body">
        <form id="createVoucherForm" action="{{ url('create-multiple-vouchers') }}" method="post">
            @csrf
            <table id="data-table" class="table table-bordered table-hover">
                <thead class="text-center">
                    <tr>
                        <th>Customer ID</th>
                        <th>Customer Name</th>
                        <th>Customer Mobile No.</th>
                        <th>Arrival Time</th>
                        <th>Depart Time</th>
                        <th>View Details</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($customer_history as $key)
                        <tr class="card-container">
                            <td class="text-center">{{ $key->customer_id }}</td>
                            <td class="text-center">{{ $key->GUEST_NAME }}</td>
                            <td class="text-center">{{ $key->GUEST_MOBILE }}</td>
                            <td class="text-center"
                                data-sort="{{ \Carbon\Carbon::parse($key->ARRIVAL)->format('Y-m-d H:i ') }}">
                                {{ \Carbon\Carbon::parse($key->ARRIVAL)->format('d-m-Y h:i A') }}</td>
                            <td class="text-center"
                                data-sort="{{ \Carbon\Carbon::parse($key->DEPART)->format('Y-m-d H:i') }}">
                                {{ \Carbon\Carbon::parse($key->DEPART)->format('d-m-Y h:i A') }}</td>
                            <td class="text-center">
                                <a type="button" class="btn btn-sm btn-default"
                                    href="{{ url('details/' . $key->customer_id) }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Includeed necessary JavaScript file -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#data-table').DataTable({
                        "order": [
                            [3, "desc"]
                        ],
                     	"iDisplayLength": 25,// Set the default number of records to display
                        "columnDefs": [{
                                "targets": 3,
                                "type": "date"
                            } // Set the first column to use date sorting
                        ]
                    });
                });
            </script>
        </form>
    </div>
@endsection
