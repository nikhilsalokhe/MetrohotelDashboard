@extends('voucher.layouts.app')
@section('content')
<div class="card m-2 border">
    <div class="card-header">
            @include('backbutton')
    <h1 class="text-center">Companies Registered</h1>
    <h3 class="text-center">{{ $company_count }}</h3>
    </div>

    {{-- <div class="container">
        <form action="{{ url('findCustomer1') }}" method="GET" role="search">

            <div class="row justify-content-center">
                <input type="date" class="form-control col-2 mx-1" name="start_date" id="datepicker" placeholder="Start" max="{{ Carbon\Carbon::now()->toDateString() }}">
                <input type="date" class="form-control col-2 mx-1" name="end_date" id="datepicker1" placeholder="End" max="{{ Carbon\Carbon::now()->toDateString() }}">
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
                        <th>Company </th>
                        <th>Company GST No</th>
                        <th>Company Customers Visits</th>
                        <th>More Details</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($customersWithSameGst as $key)
                        @php
                            $customerInfo = $customerDetails->where('gst_no', $key->gst_no)->first();
                        @endphp
                        <tr class="card-container">
                            <td>{{ $customerInfo->company_name ?? 'N/A' }}</td>
                            <td class="text-center">{{ $key->gst_no }}</td>
                            <td class="text-center">{{ $key->count}}</td>

                            <td class="text-center">
                                <a type="button" class="btn btn-sm btn-default"
                                    href="{{ url('company_customers/' . $key->gst_no) }}">
                                    <i class="fas fa-eye" ></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
      $('#data-table').DataTable({
          "iDisplayLength": 25,// Set the default number of records to display
      });
  });
</script>
@endsection