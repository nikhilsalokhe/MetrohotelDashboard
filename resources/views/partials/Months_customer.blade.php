@extends('layouts.internal')

@section('content')

    <head>
        <link href="http://code.jquery.com/ui/1.9.2/themes/smoothness/jquery-ui.css" rel="stylesheet" />
        <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
        <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    </head>
    <h1 class="text-center"> Total this months Customers</h1>
    <p class="text-right"> {{ $today1 }}</p>


    {{-- Custom Date --}}


    <div class="float-right">
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
    </div>

    {{-- end custom date --}}


    {{-- {{$data}} --}}
    <div class="card-body">
        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Customer ID</th>
                    <th>customer Name</th>
                    <th>Address</th>
                    <th>Phone No.</th>
                    <th>Arrival Date Time</th>
                </tr>
                @foreach ($data as $key)
            </thead>
            <tbody>
                <tr>
                    <td>{{ $key->Customer_Id }}</td>
                    <td>{{ $key->Guest_name }}</td>
                    <td> {{ $key->Address }}</td>
                    <td>{{ $key->Phone_no }}</td>
                    <td> {{$key->Arrival_DT}}</td>
                </tr>
            </tbody>
            @endforeach
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
@endsection
