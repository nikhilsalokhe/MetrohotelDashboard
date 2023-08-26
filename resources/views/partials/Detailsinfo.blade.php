{{-- {{$details1->Guest_name}}

@foreach ($details as $item)
    {{$item->Guest_name}}
{{$item->Arrival_DT}}
@endforeach
{{$details->sum('DAYS')}} --}}


{{-- @extends('layouts.internal') --}}
@extends('voucher.layouts.app')


@section('content')
    <div class="container">
        <div class="card m-2 border">
            <div class="card-header " style="background-color: rgb(215, 221, 228)">
            @include('backbutton')
                <h1>Guest History</h1>
                <h4>Customer Name : {{ $details1->customer_name }}</h4>
            </div>

            {{-- Search Bar --}}
            {{-- {{$data}} --}}
            <div class="card-body">
                <div class="table-responsive  px-1">
                    <table id="data-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
            					<th>Sr. No.</th>
                                <th data-order="desc">Arrival Date</th>
                                <th>Arrival Time</th>
                                <th>Departure Date</th>
                                <th>Departure Time</th>
                                <th>Room No.</th>
                                <th>PAX</th>
                                <th>Days of stay</th>
                                <th>Bill Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($details as $item)
                                {{-- {{dd($item)}} --}}
                                <tr>
                                	<td>{{ $item->serial_no }}</td>
                                    <td data-sort="{{ \Carbon\Carbon::parse($item->ARRIVAL)->format('Y-m-d H:i') }}">
                                        {{ \Carbon\Carbon::parse($item->ARRIVAL)->format('d-m-Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->ARRIVAL)->format('h:i A') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->DEPART)->format('d-m-Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->DEPART)->format('h:i A') }}</td>
                                    <td>{{ $item->ROOM }}</td>
                                    <td>{{ $item->PAX }}</td>
                                    <td>{{ $item->DAYS }}</td>
                                    <td>{{ $item->{'BILL AMOUNT'} }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td> Total Stay Days: {{ $details->sum('DAYS') }}</td>
                        <td>
                            Total Revenue Amount: {{ $revenue_amount }}
                            <p>
                                Average Room Rate: {{ $arr }}
                                <br>(Total Revenue amt/Total stay days)
                            </p>
                        </td>

                    </table>
                    <!-- Includeed necessary JavaScript file -->
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                        $(document).ready(function() {
                            $('#data-table').DataTable({
                                "order": [
                                    [0, "desc"]
                                ],
                            	"iDisplayLength": 25,// Set the default number of records to display
                                "columnDefs": [{
                                        "targets": 0,
                                        "type": "date"
                                    } // Set the first column to use date sorting
                                ]
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
@endsection
