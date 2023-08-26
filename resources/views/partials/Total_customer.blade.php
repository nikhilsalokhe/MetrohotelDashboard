@extends('voucher.layouts.app')
@section('content')
    <div class="card m-2 border">
        <div class="card-header" style="background: linear-gradient(to right, #fecb4b, #e69814);">
            @include('backbutton')
            <h2 class="text-center mb-2"> Total Customers</h2>
            <h3 class="text-center mb-3">{{ $count }}</h3>

            <div class="container">
                <form action="{{ url('findTotalCustomer') }}" method="GET" role="search">
                    <div class="row justify-content-center">
                        <input type="date" class="form-control col-2 mx-1" name="start_date" id="datepicker"
                            placeholder="Start" max="{{ Carbon\Carbon::now()->toDateString() }}"
                            value="{{ $request->input('start_date') }}">
                        <input type="date" class="form-control col-2 mx-1" name="end_date" id="datepicker1"
                            placeholder="End" max="{{ Carbon\Carbon::now()->toDateString() }}"
                            value="{{ $request->input('end_date') }}">
                        <button class="btn btn-sm btn-primary" type="submit"> Search </button>
                    </div>
                </form>
            </div>
        </div>
        {{-- {{$data}} --}}
        <div class="card-body">
            <form id="createVoucherForm" action="{{ url('create-multiple-vouchers') }}" method="post">
                @csrf
                <table id="data-table" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Customer ID</th>
                            <th>customer Name</th>
                            <th>Phone No.</th>
                            <th>Details</th>
                            <th>Voucher</th>
                            <th>Multiple Voucher</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($groupedArray as $group)
                            {{-- @foreach ($group['customer_master'] as $key) --}}
                            {{-- {{ dd($groupedArray) }} --}}
                            <tr>
                                <td>{{ $group['customer_master']->customer_id }}</td>
                                <td>{{ $group['customer_master']->customer_name }}</td>
                                <td>{{ $group['customer_master']->phone_no }}</td>
                                <td class="text-center">
                                    <a type="button" class="btn btn-sm btn-default"
                                        href="{{ url('details/' . $group['customer_master']->customer_id) }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a type="button" class="btn btn-sm btn-default"
                                        href="{{ url('customer-voucher/' . $group['customer_master']->customer_id) }}">
                                        <i class="fas fa-gift"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="selectedEmployees[]"
                                        value="{{ $group['customer_master']->customer_id }}">
                                </td>
                            </tr>
                        @endforeach
                        {{-- @endforeach --}}
                    </tbody>
                </table>
                <div class="nk-int-st">
                    <button type="button" id="selectAllButton" class="btn btn-primary">Select All Customers</button>
                    <!-- Add this input field inside the form -->

                    <button type="submit" class="btn btn-success">Create Vouchers for Selected Employees</button>
                </div>
                <input type="hidden" name="allSelectedEmployees" id="allSelectedEmployees" value="">
        </div>
    </div>
    <!-- Includeed necessary JavaScript file -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script>
        $(document).ready(function() {
            $('#data-table').DataTable({
                "iDisplayLength": 25,// Set the default number of records to display
            });
        });
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the "Select All Customers" button and all customer checkboxes
            const selectAllButton = document.getElementById('selectAllButton');
            const customerCheckboxes = document.querySelectorAll('input[name="selectedEmployees[]"]');
            const dataTable = $('#data-table')
                .DataTable({
                "iDisplayLength": 25,// Set the default number of records to display
            }); // Replace 'yourTableId' with the actual ID of your DataTable

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

                // Get the count of selected employees
                const selectedEmployeesCount = getAllSelectedEmployees().length;
                if (selectedEmployeesCount === 0) {
                    event.preventDefault(); // Prevent form submission
                    alert('Please select at least one customer before submitting.'); // Display an alert
                }
            });


        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Get references to the date input fields
            var startDateInput = $('#datepicker');
            var endDateInput = $('#datepicker1');

            // Calculate default values and set them for both inputs
            var currentDate = new Date();
            var defaultStartDate = new Date(currentDate);
            defaultStartDate.setDate(currentDate.getDate() - 29);
            startDateInput.val(defaultStartDate.toISOString().substr(0, 10));
            endDateInput.val(currentDate.toISOString().substr(0, 10));

            // Set max date for end date input
            endDateInput.attr('max', currentDate.toISOString().substr(0, 10));

            // Function to update max date for end date input
            function updateEndDateLimit() {
                var selectedStartDate = new Date(startDateInput.val());
                var maxEndDate = new Date(selectedStartDate);
                maxEndDate.setDate(selectedStartDate.getDate() + 29);

                // Calculate the maximum possible end date based on today's date
                var maxPossibleEndDate = new Date(currentDate);
                maxPossibleEndDate.setDate(currentDate.getDate() + 29);

                // Set maxPossibleEndDate to today's date if it's greater
                if (maxPossibleEndDate > currentDate) {
                    maxPossibleEndDate = currentDate;
                }
                // Set the max date for the end date input, considering the selected start date and maximum possible end date
                var maxDate = maxEndDate > maxPossibleEndDate ? maxPossibleEndDate : maxEndDate;
                endDateInput.attr('max', maxDate.toISOString().substr(0, 10));

                // If end date is beyond the maximum possible end date, adjust it
                var selectedEndDate = new Date(endDateInput.val());
                if (selectedEndDate > maxDate) {
                    endDateInput.val(maxDate.toISOString().substr(0, 10));
                }
            }

            // Update max date for end date input when start date changes
            startDateInput.on('change', function() {
                updateEndDateLimit();
            });

            // Initial call to set end date limit
            updateEndDateLimit();
        });
    </script>
@endsection
