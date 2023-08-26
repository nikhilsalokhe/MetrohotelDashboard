@extends('voucher.layouts.app')

@section('content')
    <div class="card m-2 border">
        <div class="card-header" style="background-color: rgb(215, 221, 228)">
            @include('backbutton')
            <h2 class="text-center">Customer Visits By</h2>
            <h3 class="text-center font-weight-bold">{{ $company_name }}</h3>
            <h4 class="text-center">{{ $company_customers_count }}</h4>
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
                            <th>Customer_Id</th>
                            <th>Customer Name</th>
                            <th>Visit Count</th>
                            <th>Visit Details</th>
                            <th>Voucher</th>
                            <th>Multiple Voucher</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($groupedCustomers as $group)
                            @php
                                $firstCustomer = $group->first();
                                $visitCount = $group->count();
                            @endphp
                            <tr class="card-container">
                                <td class="text-center">{{ $firstCustomer->customer_id }}</td>
                                <td>{{ $firstCustomer->GUEST_NAME }}</td>
                                <td class="text-center">{{ $visitCount }}</td>
                                <td class="text-center">
                                    <a type="button" class="btn btn-sm btn-default"
                                        href="{{ url('details/' . $firstCustomer->customer_id) }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a type="button" class="btn btn-sm btn-default"
                                        href="{{ url('customer-voucher/' . $firstCustomer->customer_id) }}">
                                        <i class="fas fa-gift"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="selectedEmployees[]"
                                        value="{{ $firstCustomer->customer_id }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


                <div class="nk-int-st">
                    <button type="button" id="selectAllButton" class="btn btn-primary">Select All Customers</button>
                    <!-- Add this input field inside the form -->

                    <button type="submit" class="btn btn-success">Create Vouchers for Selected Employees</button>
                </div>
                <input type="hidden" name="allSelectedEmployees" id="allSelectedEmployees" value="">
            </form>
        </div>
    </div>


<!-- Includeed necessary JavaScript file -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the "Select All Customers" button and all customer checkboxes
            const selectAllButton = document.getElementById('selectAllButton');
            const customerCheckboxes = document.querySelectorAll('input[name="selectedEmployees[]"]');
            const dataTable = $('#data-table')
                .DataTable({
                    "iDisplayLength": 25, // Set the default number of records to display
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
@endsection
