{{-- @extends('layouts.internal') --}}
@extends('voucher.layouts.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
    @endif
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div><br />
    @endif
    @if (\Session::has('warning'))
        <div class="alert alert-danger alert-block">
            <p>{{ \Session::get('warning') }}</p>
        </div><br />
    @endif

    <div class="card m-2 border">
        <div class="card-header">
            @include('backbutton')
            <h1 class="text-center"> Least Visited Customers</h1>
            <h3 class="text-center">{{ $leastcount }}</h3>
            {{-- Custom Date --}}
            <div class="container">
                <form action="{{ url('findLeastCustomer') }}" method="GET" role="search">
                    <div class="row justify-content-center">
                        <input type="date" class="form-control col-2 mx-1" name="start_date" id="datepicker"
                            placeholder="Start" max="{{ Carbon\Carbon::now()->toDateString() }}">
                        <input type="date" class="form-control col-2 mx-1" name="end_date" id="datepicker1"
                            placeholder="End" max="{{ Carbon\Carbon::now()->toDateString() }}">
                        <button class="btn btn-primary" type="submit"> Search </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-body">
            <form id="createVoucherForm" action="{{ url('create-multiple-vouchers') }}" method="post">
                @csrf
                <table id="data-table" class="table table-bordered table-hover">
                    <thead class="text-center">
                        <tr>
                            <th>Customer_Id</th>
                            <th>Customer Name</th>
                            <th>Mobile No.</th>
                            <th>Visites</th>
                            <th>More Details</th>
                            <th>Voucher</th>
                            <th>Multiple Voucher
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($leastVistited as $key)
                            <tr class="card-container">
                                <td class="text-center">{{ $key->customer_id }}</td>
                                <td>{{ $key->GUEST_NAME }}</td>
                                <td>{{ $key->GUEST_MOBILE }}</td>
                                <td class="text-center">{{ $key->visitcount }}</td>
                                <td class="text-center">
                                    <a type="button" class="btn btn-sm btn-default"
                                        href="{{ url('details/' . $key->customer_id) }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a type="button" class="btn btn-sm btn-default"
                                        href="{{ url('customer-voucher/' . $key->customer_id) }}">
                                        <i class="fas fa-gift"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="selectedEmployees[]" value="{{ $key->customer_id }}">
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $('#data-table').DataTable({
                            "order": [
                                [3, "asc"]
                            ],
                        	"iDisplayLength": 25,// Set the default number of records to display
                        });
                    });
                </script>

                <div class="nk-int-st">
                    <button type="button" id="selectAllButton" class="btn btn-primary">Select All Customers</button>
                    <!-- Add this input field inside the form -->

                    <button type="submit" class="btn btn-success">Create Vouchers for Selected Employees</button>
                </div>
                <input type="hidden" name="allSelectedEmployees" id="allSelectedEmployees" value="">
            </form>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <!-- Add a hidden input field to store selected customer IDs -->


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the "Select All Customers" button and all customer checkboxes
            const selectAllButton = document.getElementById('selectAllButton');
            const customerCheckboxes = document.querySelectorAll('input[name="selectedEmployees[]"]');
            const dataTable = $('#data-table-basic')
                .DataTable(

                ); // Replace 'yourTableId' with the actual ID of your DataTable

            // Function to update the "Select All Customers" button label
            function updateSelectAllButtonLabel() {
                // Determine if all customer checkboxes on the current page are checked
                const allChecked = Array.from(customerCheckboxes).every(checkbox => checkbox.checked);

                // Update the "Select All Customers" button label based on the checked state of all customer checkboxes
                selectAllButton.textContent = allChecked ? 'Deselect All Customers' : 'Select All Customers';
            }

            // Add an event listener to the "Select All Customers" button
            selectAllButton.addEventListener('click', function() {
                // Toggle the checked state of all customer checkboxes
                customerCheckboxes.forEach(function(checkbox) {
                    checkbox.checked = !checkbox.checked;
                });

                // Update the "Select All Customers" button label after clicking the button
                updateSelectAllButtonLabel();
            });
            // Function to get all selected checkbox values
            function getAllSelectedEmployees() {
                const selectedEmployees = [];
                customerCheckboxes.forEach(function(checkbox) {
                    if (checkbox.checked) {
                        selectedEmployees.push(checkbox.value);
                    }
                });
                return selectedEmployees;
            }

            // Function to update the hidden input field with selected checkbox values as a JSON string
            function updateHiddenInput() {
                const selectedEmployeesArray = getAllSelectedEmployees();
                const selectedEmployeesJSON = JSON.stringify(selectedEmployeesArray);
                document.getElementById('allSelectedEmployees').value = selectedEmployeesJSON;
            }

            // Update the hidden input field whenever the user checks/unchecks a checkbox
            customerCheckboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    updateHiddenInput();
                });
            });

            // Add a listener to DataTables draw event to update the hidden input field
            dataTable.on('draw', function() {
                updateHiddenInput();
            });

            // Add an event listener to the form submission
            document.getElementById('createVoucherForm').addEventListener('submit', function(event) {
                // Update the hidden input field with all selected checkbox values before submitting the form
                updateHiddenInput();
                // Uncomment the following line if you want to remove the hidden input from the form data
                // event.preventDefault();
            });
        });
    </script>





@endsection
