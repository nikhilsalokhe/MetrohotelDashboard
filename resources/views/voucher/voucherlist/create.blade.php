@extends('voucher.layouts.app')

@section('content')
<!-- Breadcomb area Start-->
<div class="breadcomb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcomb-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcomb-wp">
                                <div class="breadcomb-icon">
                                    <i class="notika-icon notika-edit"></i>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>Voucher</h2>
                                    <p>Create Voucher</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcomb area End-->
<!-- Form area start-->


<div class="form-example-area">
    <div class="container">
        <form id="myForm"  action="{{action('Voucher\VoucherListController@store')}}" method="POST">
            {{csrf_field()}}
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    
                    <div class="form-example-wrap">
                        <div id="table-container" class="form-example-int">
                            
                            @if(count($customers) > 0)
                            <h2 class="text-center">Selected  <span style="color: #00c292">
                                {{-- {{$count}} --}}
                            </span> Customers</h2>
                            <div class="table-responsive">
                            <table id="" class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Customer ID</th>
                                    <th>Name</th>
                                    <th>Mobile No.</th>
                                    <!-- Add other customer details headers here -->
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customers as $customer)
                                    <tr>
                                        <td>
                                            <div class="nk-int-st">
                                                {{$customer->customer_id}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control" placeholder="customer name" name="name[]" required value="{{$customer->customer_name}}" disabled>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="nk-int-st">
                                                <input type="text" class="form-control" placeholder="mobile no" name="mobile[]" required value="{{$customer->phone_no}}" disabled>
                                            </div>
                                            
                                        </td>
                                        <td>
                                            {{-- <div class="nk-int-st">
                                                <input type="hidden" class="form-control" placeholder="customer name" name="name1[]" required value="{{$customer->customer_name}}" >
                                            </div> --}}
                                            {{-- <div class="nk-int-st">
                                                <input type="hidden" class="form-control" placeholder="mobile no" name="mobile1[]" required value="{{$customer->phone_no}}" >
                                            </div> --}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                          
                            {{-- <div class="row">
                                <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="notika-icon notika-mail"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" class="form-control" placeholder="mobile no" name="mobile" required value="{{$customers[0]->phone_no}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="notika-icon notika-support"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" class="form-control" placeholder="customer name" name="name" required value="{{ $customers[0]->customer_name}}">
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            {{-- Commented Already this --}}
                            {{-- <div class="row">
                                <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="notika-icon notika-mail"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" class="form-control" placeholder="email" name="email" required value="{{ old('email') }}">
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="row">
                                <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="notika-icon notika-next"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            {{-- <select required class="selectpicker" name="voucher"> --}}
                                                <select required class="" name="voucher">
                                                <option></option>
                                                @foreach ($voucherNames as $key )
                                                    <option value="{{ $key->id }}">{{ $key->name }} * expired date on {{date("jS F, Y", strtotime($key->expired_date))}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <p>No customers selected.</p>
                        @endif
                        <div class="form-example-int mg-t-15">
                            <button class="btn btn-success notika-btn-success" type="submit">Generate Voucher</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Form area End-->
{{-- On form submission, enable the disabled input fields, submit the form, and then disable the input fields again. --}}
<script>
    document.getElementById("myForm").addEventListener("submit", function (event) {
        // Prevent the default form submission behavior
        event.preventDefault();

        // Get all the disabled input fields within the table container
        const inputFields = document.querySelectorAll("#table-container input[disabled]");

        // Enable the disabled input fields temporarily
        inputFields.forEach((input) => {
            input.disabled = false;
        });

        // Submit the form
        document.getElementById("myForm").submit();

        // Disable the input fields again after the form submission is complete
        inputFields.forEach((input) => {
            input.disabled = true;
        });
    });
</script>
@endsection
